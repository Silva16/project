<?php namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation;

class ProjectsController extends Controller
{

    public $restful = true;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {

        $state = ['1' => 'Em desenvolvimento', '2' => 'Finalizado'];

        return view('projects.create', compact('state'));
    }

    public function store(ProjectRequest $request)
    {
        //$imgs = MediaController::getImages();

        //$project = new Project();
        //$id = Project::add($project);
        //$input = $request->all();
        $date = new \DateTime();

        $user = User::find(2);

        $project = new Project();

        $project->name = Input::get('name');
        $project->type = Input::get('type');
        $project->theme = Input::get('theme');
        $project->description = Input::get('description');
        $project->started_at = Input::get('started_at');
        $project->created_by = $user->id;
        $project->updated_by = $user->id;
        $project->approved_by = 2;
        $project->featured_until = Input::get('featured_until');
        $project->state = Input::get('state');
        $project->created_at = $date->getTimestamp();
        $project->updated_at = $date->getTimestamp();

        $fields = ['acronym' => Input::get('acronym'), 'keywords' => Input::get('keywords'), 'used_software' => Input::get('used_software'), 'used_hardware' => Input::get('used_hardware'), 'observations' => Input::get('observations')];

        foreach ($fields as $key => $value){
            if (empty($value)){
                $project->$key = null;
            } else{
                $project->$key = $value;
            }
        }

        $project->save();



        return redirect()->route('author_projects');
        //return redirect('author_projects');

        /*Project::create(array(
            'name' => Input::get('name'),
            'description' => Input::get('description'),
            'started_at' => Inpu
t::get('date'),
            'created_by' => $user->id,
            'updated_by' => 2,
            'approved_by' => 2,
            'observations' => Input::get('observations'),
            'featured_until' => Input::get('featured_until'),
            'state' => Input::get('state'),
            'created_at' => $date->getTimestamp(),
            'updated_at' => $date->getTimestamp()
        ));*/


        //if($id != null){

        //}
    }

    public function index()
    {

        $imgs = MediaController::getImages();
        return view('projects/list', compact('imgs'));
    }

    public function get_list()
    {
        return view('projects.list');
    }


}