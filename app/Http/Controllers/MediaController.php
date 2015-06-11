<?php namespace App\Http\Controllers;

use App\Media;
use App\Project;
use Symfony\Component\HttpFoundation\File;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\MediaRequest;
use Auth;
use Illuminate\Support\Facades\Input;

class MediaController extends Controller {

    private $disk;




    public function index($id){

        $medias = Media::where('project_id', '=', $id)->get();

        $project = Project::find($id);
        $mimetype = array("image/jpg", "image/jpeg", "image/png", "image/bmp");

        foreach ($medias as $media){
            $image[$media->id] = action('MediaController@show', $media->int_file);

        }

        return view('media.list', compact('medias', 'project', 'mimetype', 'image'));


    }

    public function create($id){

        return view('media.store', compact('id'));
    }

    public function store($id, MediaRequest $request){

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
        } else {
            $media->state = 0;
        }

        $file = $request->file('int_file');

        if ($file != null) {

            $filename = $file->getClientOriginalName();
            $media->mime_type = $file->getmimeType($filename);
            $file->move(storage_path() . '/app/projects/', $filename);
            $fields['int_file'] = 'projects/' . $filename;
        }

        $fields['ext_url'] = Input::get('ext_url');

        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $media->$key = null;
            } else {
                $media->$key = $value;
            }
        }

        $media->save();

        return redirect('dashboard');
    }

    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, MediaRequest $request)
    {

    }

    public function show($file){

        $filename = basename($file);

        $path = storage_path() . '/app/' . $file;//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $headers = [
            'Content-Type' => 'image/jpg'
        ];

        return response()->download($path, $filename, $headers, 'inline');
    }
}