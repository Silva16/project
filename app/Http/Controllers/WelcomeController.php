<?php namespace App\Http\Controllers;

use App\Project;
use App\User;
use Auth;
use Illuminate\Validation;

class WelcomeController extends Controller
{

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
        $featured = Project::where('featured_until', '>=', date("Y-m-d"))->where('state', '=',
            '1')->orderBy('updated_at')->get();
        foreach ($featured as $project) {

            $featuredImage[$project->id] = $this->getMediaProject($project);
        }

        $projects = Project::where('state', '=', '1')->orderBy('updated_at')->paginate(5);
        foreach ($projects as $project) {
            $created_by[$project->id] = User::find($project->created_by)->name;

            $image[$project->id] = $this->getMediaProject($project);
        }

        return view('welcome', compact('projects', 'created_by', 'image', 'featured', 'featuredImage'));
    }

    private function getMediaProject($project)
    {

        $media = $project->media->first();
        if ($media != null) {

            return $featuredImage[$project->id] = action('MediaController@showProject', basename($media->int_file));
        } else {
            return $featuredImage[$project->id] = null;
        }

    }
}
