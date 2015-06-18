<?php namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Project;
use Symfony\Component\HttpFoundation\File;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\MediaRequest;
use Auth;
use Illuminate\Support\Facades\Input;

class MediaController extends Controller {

    private $disk;




    public function index($id){

        $user = Auth::user();
        $approved_by = null;

        $filter_array = array('All' => 'all', 'Refused' => '0', 'Approved' => '1', 'Pending' => '2');
        $sort_array = array('Title' => 'title', 'Mime' => 'mime_type', 'File' => 'int_file', 'Created' => 'created_at', 'Updated' => 'updated_at');
        $order_array = array('Ascendant' => 'asc', 'Descendant' => 'desc');

        if (($sort = Input::get('sort')) != null && ($order = Input::get('order')) != null && ($filter = Input::get('filter')) != null){

            $medias = $this->getMedia($id, $sort_array[Input::get('sort')], $order_array[Input::get('order')], $filter_array[Input::get('filter')]);
        }
        else {

            $medias = $this->getMedia($id);
            $sort = 'Title';
            $order = 'Ascendant';
            $filter = 'All';
        }

        $project = Project::find($id);
        $image_type = array('image/jpg', 'image/jpeg', 'image/png', 'image/bmp');

        foreach ($medias as $media){
            $file[$media->id] = action('MediaController@showProject', basename($media->int_file));
            $created_by[$media->id] = User::find($media->created_by)->name;
            if ($project->approved_by != null) {
                $approved_by[$media->id] = User::find($media->approved_by)->name;
            }
        }

        $pdfLogo = action('MediaController@showLogo', 'pdf.png');

        return view('media.list', compact('medias', 'project', 'image_type', 'file', 'pdfLogo', 'created_by', 'approved_by','sort', 'order', 'filter', 'user'));

    }

    public function create($id){

        return view('media.store', compact('id'));
    }

    public function store($id, MediaRequest $request){

        $fields = [];
        $media = new Media();

        $date = new \DateTime();

        $media->project_id = Project::find($id)->id;
        $media->title = Input::get('title');
        $media->description = Input::get('description');
        $media->alt = Input::get('alt');
        $media->flags = 0;
        $media->created_by = Auth::user()->id;
        $media->created_at = $date->getTimestamp();
        $media->updated_at = $date->getTimestamp();

        if (Auth::user()->role == 2){
            $media->state = 1;
            $media->approved_by = Auth::user()->id;
        } else {
            $media->state = 2;
        }

        $file = $request->file('int_file');

        if ($file != null) {

            $filename = $file->getClientOriginalName();
            $media->mime_type = $file->getmimeType($filename);
            $file->move(storage_path() . '/app/projects/', $filename);
            $fields['int_file'] = 'projects/' . $filename;
        }

        if ($this->youtubeID(Input::get('ext_url')) != false){
            $media->ext_url = $this->youtubeID(Input::get('ext_url'));
            $media->public_name = $this->youtubeID(Input::get('ext_url'));
            $media->mime_type = "video/youtube";
        } else {
            $fields['ext_url'] = Input::get('ext_url');
        }



        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $media->$key = null;
            } else {
                $media->$key = $value;
            }
        }

        $media->save();

        return redirect('media/index/' . $media->project_id);
    }

    public function edit($id)
    {
        $media = Media::find($id);

        return view ('media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, MediaRequest $request)
    {
        $fields = [];
        $media = Media::find($id);

        $date = new \DateTime();

        $media->title = Input::get('title');
        $media->description = Input::get('description');
        $media->alt = Input::get('alt');
        $media->created_by = Auth::user()->id;
        $media->created_at = $date->getTimestamp();
        $media->updated_at = $date->getTimestamp();

        if (Auth::user()->role == 2){
            $media->state = 1;
            $media->approved_by = Auth::user()->id;
        } else {
            $media->state = 2;
        }

        $file = $request->file('int_file');

        if ($file != null) {

            $filename = $file->getClientOriginalName();
            $media->mime_type = $file->getmimeType($filename);
            $file->move(storage_path() . '/app/projects/', $filename);
            $fields['int_file'] = 'projects/' . $filename;
        }

        if ($this->youtubeID(Input::get('ext_url')) != false){
            $media->ext_url = $this->youtubeID(Input::get('ext_url'));
            $media->public_name = $this->youtubeID(Input::get('ext_url'));
            $media->mime_type = "video/youtube";
        } else {
            $fields['ext_url'] = Input::get('ext_url');
        }



        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $media->$key = null;
            } else {
                $media->$key = $value;
            }
        }

        $media->save();

        return redirect('media/index/' . $media->project_id);
    }

    public function destroy($id)
    {
        $media = Media::find($id);

        $media->delete();

        return redirect('media/index/' . $media->project_id);
    }

    public function showProfile($file){

        //$filename = basename($file);

        $path = storage_path() . '/app/profiles/' . $file;//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $headers = [
            'Content-Type' => 'image/jpg'
        ];

        return response()->download($path, $file, $headers, 'inline');
    }

    public function showProject($file){

        //$filename = basename($file);

        $path = storage_path() . '/app/projects/' . $file;//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $headers = [
            'jpg' => 'image/jpg',
            'jpeg' => 'image/jpg',
            'png' => 'image/jpg',
            'bmp' => 'image/jpg',
            'pdf' => 'application/pdf',
        ];

        return response()->download($path, $file, $headers, 'inline');
    }

    public function showLogo($file){



        $path = storage_path() . '/app/logos/' . $file;//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $headers = [
            'Content-Type' => 'image/png'
        ];

        return response()->download($path, $file, $headers, 'inline');
    }

    private function youtubeID($url)
    {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;

    }


    private function getMedia($id, $sort = 'title', $order = 'asc', $filter = 'all'){

        if ($filter != 'all'){
            $medias = Media::where('project_id', '=', $id)->where('state', '=', $filter)->orderBy($sort, $order)->get();

        } else {
            $medias = Media::where('project_id', '=', $id)->orderBy($sort, $order)->get();
        }

        return $medias;
    }

    public function approve($id){

        $media = Media::find($id);
        $state = '1';
        $this->editState($media, $state);

        return redirect('media/index/' . $media->project_id);
    }

    public function refuse($id){

        $media = Media::find($id);

        return view('media.refusal', compact('media'));
    }

    public function refuseMessage($id){

        $media = Media::find($id);
        $state = '0';
        $message = Input::get('message');
        $this->editState($media, $state, $message);


        return redirect('media/index/' . $media->project_id);
    }

    private function editState($media, $state, $message = null){

        if ($state == 1){
            $media->state = $state;
            $media->approved_by = Auth::user()->id;
        } elseif ($state == 0) {
            $media->refusal_msg = $message;
            $media->state = $state;
        }

        $media->save();
    }
}