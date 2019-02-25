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


Route::get('/', function () {
    return view('main.save_json');
});


Route::resource('json', 'JsonController');

Route::resource('users', 'UsersController');






Route::get('api/users', function(){
    return view('all_users');
});

Route::get('api/users/{id}', function(){
    return view('user_by_id');
});

Route::get('api/users/{id}/posts', function(){
    return view('user_posts');
});