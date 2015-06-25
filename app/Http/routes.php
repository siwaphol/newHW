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
Route::get('xcrud', 'HomeController@xcrud');
//Route::get('test/{id}', function($id){
   // return $id;
//});
Route::get('assign', 'HomeController@assign');
Route::get('course', 'CourseController@course');
Route::get('create', 'CourseController@create');
Route::get('edit/{id}', 'CourseController@edit');
Route::get('delete/{id}', 'CourseController@delete');
Route::get('course/{course_id}', 'CourseController@show');
Route::get('course_section', 'Course_SectionController@index');
Route::get('course_section/create', 'Course_SectionController@create');
Route::post('course_section/create/save', 'Course_SectionController@store');
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
Route::post('test2', 'HomeController@test2');
Route::patch('teachers/update/{id}','TeachersController@update');
Route::post('teachers/create/save','TeachersController@store');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
//admin
Route::get('admin','AdminController@index');
Route::delete('admin/delete/{id}','AdminController@destroy');
Route::get('admin/show/{id}','AdminController@show');
Route::get('admin/create','AdminController@create');
Route::get('admin/{id}/edit','AdminController@edit');
Route::post('admin/create/save','AdminController@store');
Route::patch('admin/update/{id}','AdminController@update');
//ta

Route::get('ta','TasController@index');
Route::delete('ta/delete/{id}','TasController@destroy');
Route::get('ta/show/{id}','TasController@show');
Route::get('ta/create','TasController@create');
Route::get('ta/{id}/edit','TasController@edit');
Route::post('ta/create/save','TasController@store');
Route::patch('ta/update/{id}','TasController@update');

//student
Route::get('students','StudentsController@index');
Route::post('students/delete','StudentsController@destroy');
Route::get('students/show/{id}','StudentsController@show');
Route::get('students/create','StudentsController@create');
Route::get('students/edit/{id}','StudentsController@edit');
Route::post('students/export','StudentsController@export');
Route::post('students/create/save','StudentsController@store');
Route::post('students/showlist','StudentsController@showlist');
Route::patch('students/update/{id}','StudentsController@update');
//import student
Route::get('students/import','StudentsController@import');
Route::post('students/insert','StudentsController@insert');
//homework_assignment
Route::get('homework_assignment','Homework_assignmentController@index');
Route::delete('homework_assignment/delete/{id}','Homework_assignmentController@destroy');
Route::get('homework_assignment/show/{id}','Homework_assignmentController@show');

Route::get('homework_assignment/create/{id}','Homework_assignmentController@create');
Route::get('homework_assignment/{id}/edit','Homework_assignmentController@edit');
Route::post('homework_assignment/create/save','Homework_assignmentController@store');
Route::patch('homework_assignment/update/{id}','Homework_assignmentController@update');
Route::post('homework_assignment/showlist','Homework_assignmentController@showlist');

//assistant
Route::get('assistants','AssistantsController@index');
Route::delete('assistants/delete/{id}','AssistantsController@destroy');
Route::get('assistants/show/{id}','AssistantsController@show');
Route::get('assistants/create','AssistantsController@create');
Route::get('assistants/{id}/edit','AssistantsController@edit');
Route::post('assistants/create/save','AssistantsController@store');
Route::patch('assistants/update/{id}','AssistantsController@update');