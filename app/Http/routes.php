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
//Route::get('test/{id}', function($id){
   // return $id;
//});
Route::get('assign', 'HomeController@assign');
Route::get('course', 'CourseController@course');
Route::get('create', 'CourseController@create');
Route::get('edit/{id}', 'CourseController@edit');
Route::get('delete/{id}', 'CourseController@delete');
Route::get('course/{course_id}', 'CourseController@show');
Route::get('course_section', 'Course_sectionController@index');
Route::get('course_section/create', 'Course_sectionController@create');
Route::get('course_section/edit/{id}', 'Course_SectionController@edit');
Route::get('test/lis','HomeController@lis');
Route::get('teachers','TeachersController@index');
Route::get('teachers/create','TeachersController@create');
Route::get('teachers/{id}/edit','TeachersController@edit');
Route::get('teachers/show/{id}','TeachersController@show');
Route::post('teachers/delete/{id}','TeachersController@destroy');
Route::post('course','CourseController@addcourse');
Route::post('course/saveedit','CourseController@saveedit');
Route::post('course_section/update','Course_sectionController@update');
Route::post('test1', 'HomeController@test1');
Route::patch('teachers/update/{id}','TeachersController@update');
Route::post('teachers/create/save','TeachersController@store');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

