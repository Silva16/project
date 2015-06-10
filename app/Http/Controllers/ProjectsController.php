<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation;
use Auth;
class ProjectsController extends Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->middleware('author', ['except' => ['show', 'index']]);
    }

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
        $project->state          = Input::get('state');
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
        return view('projects.list');
    }

    public function show($id)
    {

        $project = Project::findOrFail($id);

        $keywords = explode(',', $project->keywords);
        return view('projects.show', compact('project', 'keywords'));

    }


}