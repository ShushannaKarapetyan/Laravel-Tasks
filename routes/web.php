<?php

//User
Route::get('/', function () {
	return view('welcome');
});

Route::get('user/home', 'HomeController@index')->name('home');

Route::resource('user/tasks', 'TaskController');

Auth::routes(['verify' => true]);

//Admin
Route::group(['middleware'=>['auth','admin']], function(){

	Route::get('admin/dashboard','admin\AdminController@index');
	Route::get('admin/tasks/{task}/edit', 'admin\AdminController@edit');
	Route::put('admin/tasks/{task}/update', 'admin\AdminController@update')->name('admin_task_update');

});



