<?php namespace App\Http\Controllers;

use App\Project;
use Symfony\Component\HttpFoundation\File;
use Illuminate\Support\Facades\Response;
use Auth;

class MediaController extends Controller {

    private $disk;


    public function profile($filename){

        $file = storage_path() . '/app/profiles/' . $filename;//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $headers = [
            'Content-Type' => 'image/jpg'
        ];

        return response()->download($file, $filename, $headers, 'inline');
    }

    public function project($filename){

        $file = storage_path() . '/app/projects/' . $filename;//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $headers = [
            'Content-Type' => 'image/jpg'
        ];

        return response()->download($file, $filename, $headers, 'inline');
    }

    public function create(){
        return view('media.store');
    }

    public function store($id, MediaRequest $request){

        $media = new Media();

        $date = new \DateTime();

        $media->project_id = Project::find($id);
        $media->title = Input::get('title');
        $media->description = Input::get('description');
        $media->alt = Hash::make(Input::get('alt'));
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
            $media->mime_type = $file->mimeType($filename);
            $file->move(storage_path() . '/app/projects/', $filename);
            $fields['int_file'] = $filename;
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

        return redirect('projects');
    }


}