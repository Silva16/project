<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Project;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

class DashboardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();

        $filter_array = array('All' => 'all', 'Refused' => '0', 'Approved' => '1', 'Pending' => '2');
        $sort_array = array('Name' => 'name', 'Acronym' => 'acronym', 'Type' => 'type', 'Theme' => 'theme', 'Started' => 'started_at', 'Updated' => 'updated_at');
        $order_array = array('Ascendant' => 'asc', 'Descendant' => 'desc');

        if (($sort = Input::get('sort')) != null && ($order = Input::get('order')) != null && ($filter = Input::get('filter')) != null){

            $array = $this->getProjects($user->id, $sort_array[Input::get('sort')], $order_array[Input::get('order')], $filter_array[Input::get('filter')]);
        }
        else {

            $array = $this->getProjects($user->id);
            $sort = 'Name';
            $order = 'Ascendant';
            $filter = 'All';
        }

        $projects = $array['projects'];
        $created_by = $array['created_by'];
        $updated_by = $array['updated_by'];

        return view('dashboard.list', compact('projects', 'user', 'filter', 'sort', 'order', 'created_by', 'updated_by'));

	}


    private function getProjects($user, $sort = 'name', $order = 'asc', $filter = 'all'){

        $created_by = null;
        $updated_by = null;

        if ($filter != 'all'){
            $projects = Project::where('state', '=', $filter)->where('created_by', '=', $user)->orderBy($sort, $order)->get();
        } else {
            $projects = Project::where('created_by', '=', $user)->orderBy($sort, $order)->get();
        }

        if ($projects != null){
            foreach($projects as $project){
                $created_by[$project->id] = User::find($project->created_by)->name;
                $updated_by[$project->id] = User::find($project->updated_by)->name;
            }
        }


        return ['projects' => $projects, 'created_by' => $created_by, 'updated_by' => $updated_by];
    }

}
