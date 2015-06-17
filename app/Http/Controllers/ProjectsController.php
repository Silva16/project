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

    public function create()
    {


        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {

        $date    = new \DateTime();
        $project = new Project();

        $project->name           = Input::get('name');
        $project->type           = Input::get('type');
        $project->theme          = Input::get('theme');
        $project->description    = Input::get('description');
        $project->started_at     = Input::get('started_at');
        $project->created_by     = Auth::user()->id;
        $project->updated_by     = Auth::user()->id;
        $project->featured_until = Input::get('featured_until');
        $project->created_at     = $date->getTimestamp();
        $project->updated_at     = $date->getTimestamp();

        if (Auth::user()->role == 2){
            $project->state = 1;
        } else {
            $project->state = 0;
        }



        $fields = ['acronym' => Input::get('acronym'), 'finished_at' => Input::get('finished_at'), 'keywords' => Input::get('keywords'),
            'used_software' => Input::get('used_software'), 'used_hardware' => Input::get('used_hardware'),
            'observations' => Input::get('observations')];

        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $project->$key = null;
            } else {
                $project->$key = $value;
            }
        }

        if ($project->save()) {
            $user_id= Auth::user()->id;
            $project->users()->sync(array($user_id));
        }



        return redirect('projects');
    }

    public function index()
    {
        $sort_array = array('Author' => 'created_by','Date' => 'started_at','Project' => 'name','Last Update' => 'updated_at');
        $order_array = array('Ascendant' => 'asc', 'Descendant' => 'desc');

        if (($sort = Input::get('sort')) != null && ($order = Input::get('order')) != null){

            $array = $this->getProjects($sort_array[Input::get('sort')], $order_array[Input::get('order')]);
        }
        else {
            $array = $this->getProjects();
            $sort = 'Last Update';
            $order = 'Descendant';
        }

        $projects = $array['projects'];
        $created_by = $array['created_by'];
        $image = $array['images'];

        return view('projects.list', compact('projects', 'created_by', 'image', 'sort', 'order'));
    }

    public function show($id)
    {

        $project = Project::findOrFail($id);
        $media = $project->media->first();

        if($media != null){
            $image = action('MediaController@showProject', basename($media->int_file));
        }
        else{
            $image = null;
        }

        $keywords = explode(',', $project->keywords);
        return view('projects.show', compact('project', 'keywords', 'image'));

    }


    public function gallery($id)
    {
/*        $medias = Media::where('project_id', '=', $id);

        foreach($medias as $media){
            var_dump($media->name);
        }*/

        $project = Project::findOrFail($id);

        foreach ($project->media as $media){
            $image[$media->id] = action('MediaController@show_project', basename($media->int_file));

        }

        return view('projects.gallery', compact('project', 'image'));

    }


    private function getProjects($sort = 'updated_at', $order = 'desc'){


        $projects = Project::where('state', '=', '1')->orderBy($sort, $order)->paginate(5);

        foreach($projects as $project){
            $created_by[$project->id] = User::find($project->created_by)->name;
            $media = $project->media->first();
            if($media != null){
                $image[$project->id] = action('MediaController@showProject', basename($media->int_file));
            }
            else{
                $image[$project->id] = null;
            }
        }

        return ['projects' => $projects, 'created_by' => $created_by, 'images' =>  $image];
    }

}