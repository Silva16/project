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

class UsersController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::with(array('institution'))->get();

        $users = array_values(array_sort($users, function($value)
        {
            return $value['name'];
        }));

        $role = ['1' => 'Autor', '2' => 'Editor', '4' => 'Administrador'];

        foreach ($users as $user){
            $image[$user->id] = action('MediaController@show', $user->photo_url);

        }

        return view('users.list', compact('users', 'image', 'role'));
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
        $institutions = Institution::lists('name','id');
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

        if ($image != null){
            $filename = $image->getClientOriginalName();
            $request->file('photo_url')->move(storage_path() . '/app/profiles/', $image->getClientOriginalName());
            $fields['photo_url'] = $filename;
        }


        $fields = ['profile_url' => Input::get('profile_url'), 'alt_email' => Input::get('alt_email')];

        foreach ($fields as $key => $value){
            if (empty($value) || $value == null){
                $user->$key = null;
            } else{
                $user->$key = $value;
            }
        }

        $user->save();

        return redirect('users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        //$users = User::all();




	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$user = User::find($id);

        $roles = User::get_roles();
        $institutions = Institution::lists('name','id');
        $status = User::get_status();
        return view ('users.edit', compact('user', 'institutions', 'roles', 'status'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UserRequest $request)
	{
        $user = User::find($id);
        $date = new \DateTime();

        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $password = Input::get('password');
        if (!empty($password)){
            $user->password = Hash::make($password);
        }
        $user->institution_id = Input::get('id');
        $user->position = Input::get('position');
        $user->role = Input::get('role');
        $user->flags = Input::get('status');
        $user->created_at = $date->getTimestamp();
        $user->updated_at = $date->getTimestamp();

        $image = $request->file('photo_url');
        if ($image != null){
            $filename = $image->getClientOriginalName();
            $request->file('photo_url')->move(storage_path() . '/app/profiles/', $image->getClientOriginalName());
            $fields['photo_url'] = $filename;
        }

        $fields = ['photo_url' => $image->getClientOriginalName(), 'profile_url' => Input::get('profile_url')];

        foreach ($fields as $key => $value){
            if (empty($value)){
                $user->$key = null;
            } else{
                $user->$key = $value;
            }
        }

        $user->save();


        return redirect('users');
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

        return redirect('users');
	}

    public function status()
    {


    }



}
