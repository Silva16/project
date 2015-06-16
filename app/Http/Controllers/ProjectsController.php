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
        $array = $this->getProjects();

        $projects = $array['projects'];
        $created_by = $array['created_by'];
        $image = $array['images'];

        return view('projects.list', compact('projects', 'created_by','image'));
    }

    public function show($id)
    {

        $project = Project::findOrFail($id);
        $media = $project->media->first();
        $image[$project->id] = action('MediaController@show_project', basename($media->int_file));

        $keywords = explode(',', $project->keywords);
        return view('projects.show', compact('project', 'keywords', 'image'));

    }

    public function filter()
    {
        $filter = array('Author' => 'created_by','Date' => 'started_at','Project' => 'name');
        $array = $this->getProjects();

        $projects = $array['projects'];
        $created_by = $array['created_by'];
        $image = $array['images'];

        $key = $filter[Input::get('filter')];


/*        $projects = array_values(array_sort($projects, function($value)
        {

            $key = $filter[Input::get('filter')];
            return $value[$key];
        }));*/

        return view('projects.list', compact('projects', 'created_by','image'));

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


    private function getProjects($sort = 'updated_at'){


        $projects = Project::where('state', '=', '1')->orderBy($sort)->paginate(5);

        foreach($projects as $project){
            $created_by[$project->id] = User::find($project->created_by)->name;
            $media = $project->media->first();
            $image[$project->id] = action('MediaController@show_project', basename($media->int_file));
        }

        return ['projects' => $projects, 'created_by' => $created_by, 'images' =>  $image];
    }

}