<?php

namespace App\Http\Controllers;

use App\Media;
use App\Project;
use App\User;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation;
use Auth;

class ProjectsController extends Controller
{
    public $restful = true;

    /*    public function __construct()
        {
            $this->middleware('author', ['except' => ['show', 'index']]);
        }*/

    public function index()
    {

        /* $sort_array = array('Author' => 'created_by','Date' => 'started_at','Project' => 'name','Last Update' => 'updated_at');
         $order_array = array('Ascendant' => 'asc', 'Descendant' => 'desc');

         if (($sort = Input::get('sort')) != null && ($order = Input::get('order')) != null){

             $array = $this->getProjects($sort_array[Input::get('sort')], $order_array[Input::get('order')]);
         }
         else {
             $array = $this->getProjects();
             $sort = 'Last Update';
             $order = 'Descendant';
         }


         if(Input::get('name'))
             $array->where('name', '=', Input::get('name'));

         if(Input::get('acronym'))
             $array->where('hasCoffeeMachine', '=', Input::get('hasCoffeeMachine'));
         $projects = $array['projects'];
         $created_by = $array['created_by'];
         $image = $array['images'];

         return view('projects.list', compact('projects', 'created_by', 'image', 'sort', 'order'));*/


        $sort_array = array(
            'Author' => 'created_by',
            'Date' => 'started_at',
            'Project' => 'name',
            'Last Update' => 'updated_at'
        );
        $order_array = array('Ascendant' => 'asc', 'Descendant' => 'desc');

        if (($sort = Input::get('sort')) == null) {
            $sort = 'Last Update';
        }

        if (($order = Input::get('order')) == null) {
            $order = 'Descendant';
        }


        if (Input::get('search') != null) {
            $projects = Project::where('name', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('acronym', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('keywords', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('description', 'LIKE', '%' . Input::get('search') . '%')
                ->where('state', '=', '1')
                ->orderBy($sort_array[$sort], $order_array[$order])
                ->paginate(5);

        } else {

            $projects = Project::where('state', '=', '1')->orderBy($sort_array[$sort], $order_array[$order]);

            if (Input::get('name') != null) {
                $projects->where('name', 'LIKE', '%' . Input::get('name') . '%');
            }

            if (Input::get('acronym') != null) {
                $projects->where('acronym', 'LIKE', '%' . Input::get('acronym') . '%');
            }

            if (Input::get('created_by') != null) {
                $projects->where('created_by', '=', Input::get('created_by'));
            }

            if (Input::get('keywords') != null) {
                $projects->where('keywords', 'LIKE', '%' . Input::get('keywords') . '%');
            }
            $projects = $projects->paginate(5);
        }


        foreach ($projects as $project) {
            $created_by[$project->id] = User::find($project->created_by)->name;
            $media = $project->media()->where('state', '=', '1')->first();
            if ($media != null) {
                $image[$project->id] = action('MediaController@showProject', basename($media->int_file));
            } else {
                $image[$project->id] = null;
            }
        }

        return view('projects.list', compact('projects', 'created_by', 'image', 'sort', 'order'));

    }

    public function create()
    {


        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {


        $project = new Project();
        $date = new \DateTime();

        $project->name = Input::get('name');
        $project->type = Input::get('type');
        $project->theme = Input::get('theme');
        $project->description = Input::get('description');
        $project->started_at = Input::get('started_at');
        $project->created_by = Auth::user()->id;
        $project->updated_by = Auth::user()->id;
        $project->featured_until = date('Y-m-d', strtotime("+30 days"));
        $project->created_at = $date->getTimestamp();
        $project->updated_at = $date->getTimestamp();

        if (Auth::user()->role == 2) {
            $project->state = 1;
        } else {
            $project->state = 2;
        }


        $fields = [
            'acronym' => Input::get('acronym'),
            'finished_at' => Input::get('finished_at'),
            'keywords' => Input::get('keywords'),
            'used_software' => Input::get('used_software'),
            'used_hardware' => Input::get('used_hardware'),
            'observations' => Input::get('observations')
        ];

        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $project->$key = null;
            } else {
                $project->$key = $value;
            }
        }

        if ($project->save()) {
            $user_id = Auth::user()->id;
            $project->users()->sync(array($user_id));
        }


        return redirect('dashboard');
    }


    public function show($id)
    {

        $project = Project::findOrFail($id);
        $media = $project->media->first();

        if ($media != null) {
            $image = action('MediaController@showProject', basename($media->int_file));
        } else {
            $image = null;
        }

        $keywords = explode(',', $project->keywords);

        return view('projects.show', compact('project', 'keywords', 'image'));

    }

    public function edit($id)
    {

        $project = Project::find($id);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ProjectRequest $request)
    {
        $project = Project::find($id);
        $date = new \DateTime();

        $project->name = Input::get('name');
        $project->type = Input::get('type');
        $project->theme = Input::get('theme');
        $project->description = Input::get('description');
        $project->started_at = Input::get('started_at');
        $project->created_by = Auth::user()->id;
        $project->updated_by = Auth::user()->id;
        $project->featured_until = date('Y-m-d', strtotime("+30 days"));
        $project->created_at = $date->getTimestamp();
        $project->updated_at = $date->getTimestamp();

        if (Auth::user()->role == 2) {
            $project->state = 1;
        } else {
            $project->state = 2;
        }


        $fields = [
            'acronym' => Input::get('acronym'),
            'finished_at' => Input::get('finished_at'),
            'keywords' => Input::get('keywords'),
            'used_software' => Input::get('used_software'),
            'used_hardware' => Input::get('used_hardware'),
            'observations' => Input::get('observations')
        ];

        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $project->$key = null;
            } else {
                $project->$key = $value;
            }
        }

        if ($project->save()) {
            $user_id = Auth::user()->id;
            $project->users()->sync(array($user_id));
        }


        return redirect('dashboard');
    }


    public function gallery($id)
    {
        /*        $medias = Media::where('project_id', '=', $id);

                foreach($medias as $media){
                    var_dump($media->name);
                }*/

        $project = Project::findOrFail($id);
        $image_type = array('image/jpg', 'image/jpeg', 'image/png', 'image/bmp');

        foreach ($project->media as $media) {

            if ($media->state == 1) {
                $file[$media->id] = action('MediaController@showProject', basename($media->int_file));
            }
        }

        $pdfLogo = action('MediaController@showLogo', 'pdf.png');

        return view('projects.gallery',
            compact('project', 'image_type', 'video_type', 'document_type', 'file', 'pdfLogo'));

    }


    private function getProjects($sort = 'updated_at', $order = 'desc')
    {


        $projects = Project::where('state', '=', '1')->orderBy($sort, $order)->paginate(5);

        foreach ($projects as $project) {
            $created_by[$project->id] = User::find($project->created_by)->name;
            $media = $project->media()->where('state', '=', '1')->first();
            if ($media != null) {
                $image[$project->id] = action('MediaController@showProject', basename($media->int_file));
            } else {
                $image[$project->id] = null;
            }
        }

        return ['projects' => $projects, 'created_by' => $created_by, 'images' => $image];
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        $project->delete();

        return redirect('dashboard');
    }

}