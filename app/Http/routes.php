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


Route::get('projects', ['as' => 'author_projects', 'uses' => 'ProjectsController@list']);

Route::get('projects/create', ['as' => 'create_project', 'uses' => 'ProjectsController@create']);

Route::post('projects/store', ['as' => 'store_project', 'uses' => 'ProjectsController@store']);

Route::get('users/create', ['as' => 'create_user', 'uses' => 'UsersController@create']);

Route::post('users/store', ['as' => 'store_user', 'uses' => 'UsersController@store']);

Route::patch('users/{id}/update', ['as' => 'update_user', 'uses' => 'UsersController@update']);

Route::get('users/{id}/edit', ['as' => 'edit_user', 'uses' => 'UsersController@edit']);

Route::post('users/{id}/delete', ['as' => 'destroy_user', 'uses' => 'UsersController@destroy']);

//Route::resource('users', 'UsersController');

Route::get('users/list', ['as' => 'list_users', 'uses' => 'UsersController@show']);

Route::get('list', 'ProjectsController@index');

Route::resource('media', 'MediaController');

Route::get(
    '/images/{file}',
    'MediaController@getImage'
);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
