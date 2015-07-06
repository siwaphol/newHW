<?php namespace App\Http\Controllers;

use App\Course;
use Request;
use Session;
use DB;
class HomeController extends Controller {

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
	public function index()
	{
		return view('home');
	}

    public function info(){
        return view('info/info');
    }
    public function test()
    {
       return view('test');
    }
    public function assign(){
        return view('assign',array('course'=>'204219'
                                    ,'section'=>'001'));
    }

    public function course(){
        $model=Course::all();

        return view('course',compact('model'));
    }

    /**
     * @return array
     */
    public function semester(){
        $model=Request::all();
        Session::put('semester',Request::get('semester'));
        Session::put('year',Request::get('year'));
        Session::forget('course_list');
        $sql=DB::select('select * from course_section where semester=? and year=?',array(Session::get('semester'),Session::get('year')));
        $course_list_str = "";
        foreach($sql as $course){
            if($course_list_str === ''){
                $course_list_str = $course->course_id;
            }else{
                $course_list_str = $course_list_str . ',' . $course->course_id;
            }
        }
        Session::put('course_list',$course_list_str);
        return view('home');
        //return view('course',compact('model'));
    }
}
