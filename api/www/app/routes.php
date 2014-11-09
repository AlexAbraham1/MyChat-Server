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

//Home Controller
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHome'));

Route::get('login', array('as' => 'login', 'before' => 'guest', 'uses' => 'HomeController@showLogin'));

Route::post('login', 'HomeController@login');

Route::get('logout', array('as' => 'logout', 'before' => 'auth', 'uses' => 'HomeController@logout'));

Route::get('profile', array('as' => 'profile', 'before' => 'auth', 'uses' => 'HomeController@showProfile'));

Route::get('new/user', array('as' => 'create_user', 'before' => 'guest', 'uses' => 'HomeController@showNewUser'));

Route::post('new/user', 'HomeController@createNewUser');

// Route::get('/delete/users/{id}', function($id) {
// 	$user = User::find($id);
// 	$user->delete();
// });





Route::get('messages', array('as' => 'messages', 'before' => 'auth', 'uses' => 'MessageController@getAllMessages'));

Route::post('new/message', array('as' => 'new_message', 'before' => 'auth', 'uses' => 'MessageController@addMessage'));
