<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('comments/index/{id}', 'CommentsController@index');

Route::get('comments/create/{id}', 'CommentsController@create');

Route::post('comments/store/{id}', 'CommentsController@store');

Route::post('comments/approve/{id}', 'CommentsController@approve');

Route::get('comments/refuse/{id}', 'CommentsController@refuse');

Route::patch('comments/refuseMsg/{id}', 'CommentsController@refuseMessage');

Route::resource('dashboard', 'DashboardController');

Route::post('project/approve/{id}', 'ProjectsController@approve');

Route::post('project/refuse/{id}', 'ProjectsController@refuse');

Route::resource('projects', 'ProjectsController');

Route::get('users/admin', ['as' => 'users.admin', 'uses' => 'UsersController@admin']);

Route::resource('users', 'UsersController');

Route::get('projects/gallery/{id}', 'ProjectsController@gallery');

Route::get('media/index/{id}', 'MediaController@index');

Route::get('media/create/{id}', 'MediaController@create');

Route::post('media/store/{id}', 'MediaController@store');

Route::patch('media/update/{id}', 'MediaController@update');

Route::get('media/edit/{id}', 'MediaController@edit');

Route::get('media/projects/{id}', 'MediaController@showProject');

Route::get('media/profiles/{id}', 'MediaController@showProfile');

Route::get('media/logos/{id}', 'MediaController@showLogo');

Route::get('media/download/{id}', 'MediaController@download');

Route::delete('media/delete/{id}', 'MediaController@destroy');

Route::post('media/approve/{id}', 'MediaController@approve');

Route::get('media/refuse/{id}', 'MediaController@refuse');

Route::patch('media/refuseMsg/{id}', 'MediaController@refuseMessage');


/*Route::get('media/{id}', 'MediaController@index');

Route::get('projects', 'ProjectsController@index');

Route::get('media/{id}', 'MediaController@profile');

Route::get('media/', 'MediaController@project');

Route::get('media/create', 'MediaController@create');

Route::get('projects', ['as' => 'author_projects', 'uses' => 'ProjectsController@index']);

Route::get('projects/create', ['as' => 'create_project', 'uses' => 'ProjectsController@create']);

Route::post('projects/store', ['as' => 'store_project', 'uses' => 'ProjectsController@store']);

Route::get('projects/{id}', ['as' => 'project', 'uses' => 'ProjectsController@show']);

Route::get('users/create', ['as' => 'create_user', 'uses' => 'UsersController@create']);

Route::post('users/store', ['as' => 'store_user', 'uses' => 'UsersController@store']);

Route::patch('users/{id}/update', ['as' => 'update_user', 'uses' => 'UsersController@update']);

Route::get('users/{id}/edit', ['as' => 'edit_user', 'uses' => 'UsersController@edit']);

Route::post('users/{id}/delete', ['as' => 'destroy_user', 'uses' => 'UsersController@destroy']);

Route::resource('media', 'MediaController');

Route::post('users', 'UsersController@status');

Route::get('users/list', ['as' => 'list_users', 'uses' => 'UsersController@show']);*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);