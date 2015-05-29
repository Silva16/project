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

Route::get('home', 'HomeController@index');

Route::get('projects', ['as' => 'author_projects', 'uses' => 'ProjectsController@list']);

Route::get('projects/create', ['as' => 'create_project', 'uses' => 'ProjectsController@create']);

Route::post('projects/store', ['as' => 'store_project', 'uses' => 'ProjectsController@store']);

Route::get('list', 'ProjectsController@index');

Route::get(
    '/images/{file}',
    'MediaController@getImage'
);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
