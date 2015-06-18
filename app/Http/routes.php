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
Route::get('info', 'HomeController@info');

Route::get('test', 'HomeController@test');
Route::get('test/{id}', function($id){
    return $id;
});
Route::get('assign', 'HomeController@assign');
Route::get('course', 'CourseController@course');
Route::get('create', 'CourseController@create');
Route::get('edit/{id}', 'CourseController@edit');
Route::get('delete/{id}', 'CourseController@delete');
Route::get('course/{course_id}', 'CourseController@show');
Route::post('course','CourseController@addcourse');
Route::post('course/saveedit','CourseController@saveedit');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
