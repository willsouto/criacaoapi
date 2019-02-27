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

Route::get('cadastrar', function(){
    return view('main.create');
});
Route::get('users/edit/{id}', function($id){
    return view('main.edit', compact('id'));
});

Route::get('users/posts/{id}', function($id){
    return view('main.posts', compact('id'));
});



Route::get('api/users', function(){
    return view('api.all_users');
});

Route::get('api/users/{id}', function($id){
    return view('api.user_by_id', compact('id'));
});

Route::get('api/users/{id}/posts', function($id){
    return view('api.user_posts', compact('id'));
});