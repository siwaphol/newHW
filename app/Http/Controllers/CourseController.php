<?php
/**
 * Created by PhpStorm.
 * User: boonchuay
 * Date: 18/6/2558
 * Time: 20:31
 */
 namespace App\Http\Controllers;

use App\Course;
use Request;

class CourseController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */


    public function course(){
    $model=Course::all();
    //$users = Course::order_by('list_order', 'ASC')->get();
    // return $view->with('users', $users)->with('q', $q);
    return view('course',compact('model'));
}
    public function create(){

        return view('creatcourse');
    }
    public function addcourse()
    {
        $input = Request::all();
        $Course=Course::create($input);

        return redirect('course');
    }
    public function show($course_id){

        return $course_id;
    }
    public function edit($id){

        $course=Course::find($id);
        return view('course.edit',compact('course'));
    }
    public function saveedit(){

    $input = Request::get('id');
    $Course=Course::findOrfail($input);
    $input=Request::all();
    $Course->fill($input)->save();
    return redirect('course');

}
    public function delete($id){
        $Course=Course::findOrfail($id);
        $Course->delete();
        return redirect('course');

    }

}
