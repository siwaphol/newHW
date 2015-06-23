<?php namespace App\Http\Controllers;

use App\Course;
use Request;

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
   //$name='boonchuay';


       return view('test');
    }
    public function assign(){
        return view('assign',array('course'=>'204219'
                                    ,'section'=>'001'));
    }

    public function course(){
        $model=Course::all();
        //$users = Course::order_by('list_order', 'ASC')->get();
       // return $view->with('users', $users)->with('q', $q);
        return view('course',compact('model'));
    }
    public function lis(){

    return view('lis');
}
    public function test1()
    {
        $result=Request::get('name');


        return $result;
    }
    public function test2()
    {
        $result=Request::get('ddlCourse');


        return $result;
    }
}
