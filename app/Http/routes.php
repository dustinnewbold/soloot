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

Route::resource('/', 'TrackerController');
Route::get('admin',  ['as' => 'admin.index', 'uses' => 'AdminController@index'] );
Route::post('admin', ['as' => 'admin.store', 'uses' => 'AdminController@store']);
Route::get('admin/import', 'AdminController@viewImport');
Route::resource('members', 'MembersController');
Route::resource('raids', 'RaidsController');
Route::resource('items', 'ItemsController');

// Route::get('sessiontest', function() {
// 	session_start();
// 	Session::put('session', $_SESSION);
// 	return Session::all();
// });

// Route::get('home', 'HomeController@index');

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);
