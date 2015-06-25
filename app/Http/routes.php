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

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);