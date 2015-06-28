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
}
