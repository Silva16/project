<?php namespace App\Http\Controllers;

use App\Media;
use App\Project;
use App\User;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation;
use Auth;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $projects = Project::where('state', '=', '1')->orderBy('updated_at')->paginate(5);

        foreach($projects as $project){
            $created_by[$project->id] = User::find($project->created_by)->name;
            $media = $project->media->first();
            $image[$project->id] = action('MediaController@show_project', basename($media->int_file));
        }

        $featured = Project::where('featured_until', '>=', date("Y-m-d"))->orderBy('updated_at')->get();

        foreach($featured as $project){
            $media = $project->media->first();
            $featuredimage[$project->id] = action('MediaController@show_project', basename($media->int_file));
        }
        return view('welcome', compact('projects', 'created_by','image', 'featured', 'featuredimage'));
	}



}
