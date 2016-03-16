<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('/', function()
{
	return  route('FrontController@home');
});

Route::group(['prefix' => 'acheteur'], function () {
	// Index
	Route::get('', 'EventController@index');
	// Events
	Route::resource('event', 'EventController');
	Route::get('event/{id}/delete', 'EventController@delete');
	// Users
	Route::resource('user', 'UserController');
	Route::get('user/{id}/delete', 'UserController@delete');
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'UserController@getLogout');
});
