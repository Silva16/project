<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Project;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Institution;
use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    /*    public function __construct()
        {
            $this->middleware('admin');
        }*/

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (($sort = Input::get('sort')) == null) {
            $sort = 'id';
        }
        if (($order = Input::get('order')) == null) {
            $order = 'asc';
        }

        $users = User::with(array('institution'))->orderBy($sort, $order);
        if(Input::get('name') != '')
            $users->where('name', 'LIKE', '%'.Input::get('name').'%');

        if(Input::get('position') != '')
            $users->where('position', 'LIKE', '%'.Input::get('position').'%');

        if(Input::get('email') != '')
            $users->where('email', 'LIKE', '%'.Input::get('email').'%');

        if(Input::get('id') != 0)
            $users->where('id', '=', Input::get('id'));
        if(Input::get('institution') != 0)
            $users->where('institution_id', '=', Input::get('institution'));
        if(Input::get('role') != 0)
            $users->where('role', '=', Input::get('role'));

        $users = $users ->paginate(10);

        foreach ($users as $user) {
            $image[$user->id] = action('MediaController@showProfile', $user->photo_url);

        }

        $institutions[0] = "Escolha uma opção...";
        $institutionsAux = Institution::get();
        foreach($institutionsAux as $institution){
            $institutions[$institution->id] = $institution->name;
        }
        $role[0] = "Escolha uma opção...";

        $role[1] = "Author";

        $role[2] = "Editor";

        $role[4] = "Administrator";

        return view('users.list', compact('users', 'image', 'role', 'institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $roles = User::get_roles();
        $status = User::get_status();
        $institutions = Institution::lists('name', 'id');

        return view('users.create', compact('institutions', 'roles', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {

        $user = new User();

        $date = new \DateTime();

        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->institution_id = Input::get('id');
        $user->position = Input::get('position');
        $user->role = Input::get('role');
        $user->flags = Input::get('status');
        $user->created_at = $date->getTimestamp();
        $user->updated_at = $date->getTimestamp();


        $image = $request->file('photo_url');

        if ($image != null) {
            $filename = $image->getClientOriginalName();
            $image->move(storage_path() . '/app/profiles/', $filename);
            $fields['photo_url'] = $filename;
        }


        $fields = ['profile_url' => Input::get('profile_url'), 'alt_email' => Input::get('alt_email')];

        foreach ($fields as $key => $value) {
            if (empty($value) || $value == null) {
                $user->$key = null;
            } else {
                $user->$key = $value;
            }
        }

        $user->save();

        return redirect('admin.users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */


    public function show()
    {
        //$users = User::all();


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $user = User::find($id);

        $roles = User::get_roles();
        $institutions = Institution::lists('name', 'id');
        $status = User::get_status();

        return view('users.edit', compact('user', 'institutions', 'roles', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, UserRequest $request)
    {
        $user = User::find($id);
        $date = new \DateTime();

        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $password = Input::get('password');
        if (!empty($password)) {
            $user->password = Hash::make($password);
        }
        $user->institution_id = Input::get('id');
        $user->position = Input::get('position');
        $user->role = Input::get('role');
        $user->flags = Input::get('status');
        $user->created_at = $date->getTimestamp();
        $user->updated_at = $date->getTimestamp();

        $image = $request->file('photo_url');
        if ($image != null) {
            $filename = $image->getClientOriginalName();
            $image->move(storage_path() . '/app/profiles/', $filename);
            $fields['photo_url'] = $filename;
        }

        $fields['profile_url'] = Input::get('profile_url');

        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $user->$key = null;
            } else {
                $user->$key = $value;
            }
        }

        $user->save();



        return redirect('admin.users');
    }
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $user = User::find($id);

        $user->delete();

        return redirect('admin.users');
    }

    public function status()
    {


    }
}
