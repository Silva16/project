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
        $featured = Project::where('featured_until', '>=', date("Y-m-d"))->orderBy('updated_at')->get();
        foreach($featured as $project){

            $media1 = $project->media->first();
            if($media1 != null){

                $featuredImage[$project->id] = action('MediaController@show_project', basename($media1->int_file));
            }
            else{
                $featuredImage[$project->id] = null;
            }
        }

        $projects = Project::where('state', '=', '1')->orderBy('updated_at')->paginate(5);
        foreach($projects as $project){
            $created_by[$project->id] = User::find($project->created_by)->name;
            $media2 = $project->media->first();

            if($media2 != null){

                $image[$project->id] = action('MediaController@show_project', basename($media2->int_file));
            }
            else{
                $image[$project->id] = null;
            }
        }
        return view('welcome', compact('projects', 'created_by','image', 'featured', 'featuredImage'));
	}



}
