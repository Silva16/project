<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Project;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Institution;
use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
        $user->password = Input::get('password');
        $user->institution_id = Input::get('id');
        $user->position = Input::get('position');
        $user->role = Input::get('role');
        $user->flags = Input::get('status');
        $user->created_at = $date->getTimestamp();
        $user->updated_at = $date->getTimestamp();

        /*$imageName = $request->file('photo_url')->getFilename();
        $user->photo_url = $imageName;

        $request->file('photo_url')->move(base_path() . '/storage/imgs/', $imageName);

        /*$fields = ['alt_email' => Input::get('alt_email')];

        foreach ($fields as $key => $value){
            if (empty($value)){
                $user->$key = null;
            } else{
                $user->$key = $value;
            }
        }*/



        $user->save();


        return redirect()->route('/users/list');
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

		$users = User::with(array('institution'))->get();

        return view('users.list', compact('users'));
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
        var_dump($user);
        $date = new \DateTime();

        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $password = Input::get('password');
        if (!empty($password)){
            $user->password = $password;
        }
        $user->institution_id = Input::get('institution_id');
        $user->position = Input::get('position');
        $user->role = Input::get('role');
        $user->flags = Input::get('status');
        $user->created_at = $date->getTimestamp();
        $user->updated_at = $date->getTimestamp();

        /*$fields = ['alt_email' => Input::get('acronym'), 'keywords' => Input::get('keywords'), 'used_software' => Input::get('used_software'), 'used_hardware' => Input::get('used_hardware'), 'observations' => Input::get('observations')];

        foreach ($fields as $key => $value){
            if (empty($value)){
                $user->$key = null;
            } else{
                $project->$key = $value;
            }
        }*/

        $user->save();


        return redirect()->route('users/list');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
