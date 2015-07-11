<?php namespace App\Http\Controllers;
//use App\Http\Controllers\Auth;
use App\Course;
use Auth;
use Request;
use Session;
use DB;
use App\User;
use Illuminate\Http\RedirectResponse;
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
        $sql=DB::select('select * from course_section where semester=? and year=? ORDER by course_id',array(Session::get('semester'),Session::get('year')));
        $course_list_str = "";
        foreach($sql as $course){
            if($course_list_str === ''){
                $course_list_str = $course->course_id;
            }else{
                $course_list_str = $course_list_str . ',' . $course->course_id;
            }
        }
        Session::put('course_list',$course_list_str);
        return new RedirectResponse(url('home'));
        //return view('course',compact('model'));
    }
    public function firstpage(){
       // if(Auth::user()->isAdmin()) {
        if(\Auth::user()->isAdmin()) {
            $result = DB::select('select DISTINCT cs.course_id as courseid
                              ,cs.section as sectionid
                              ,co.name as coursename
                              from course_section cs
                              left join courses co on cs.course_id=co.id
                              where cs.semester=? and cs.year=?
                              order by cs.course_id,cs.section
                              ', array(Session::get('semester'), Session::get('year')));
        }
        if(\Auth::user()->isTeacher()) {
            $result = DB::select('select DISTINCT cs.course_id as courseid
                              ,cs.section as sectionid
                              ,co.name as coursename
                              from course_section cs
                              left join courses co on cs.course_id=co.id
                              WHERE cs.semester=? and cs.year=? and cs.teacher_id=?
                              order by cs.course_id,cs.section
                              ', array(Session::get('semester'), Session::get('year'),Auth::user()->id));
        }
        if(\Auth::user()->isTa()) {
            $result = DB::select('select DISTINCT  cs.course_id as courseid
                              ,cs.section as sectionid
                              ,co.name as coursename
                              from course_ta cs
                              left join courses co on cs.course_id=co.id
                              WHERE cs.semester=? and cs.year=? and cs.student_id=?
                              order by cs.course_id,cs.section
                              ', array(Session::get('semester'), Session::get('year'),Auth::user()->id));
        }
        if(\Auth::user()->isStudent()) {
            $result = DB::select('select DISTINCT cs.course_id as courseid
                              ,cs.section as sectionid
                              ,co.name as coursename
                              from course_student cs
                              left join courses co on cs.course_id=co.id
                              WHERE cs.semester=? and cs.year=? and cs.student_id=?
                              order by cs.course_id,cs.section
                              ', array(Session::get('semester'), Session::get('year'),Auth::user()->id));
        }
        //}
//        if(Auth::user()->isTeacher()) {
//            $result = DB::select('select cs.course_id as courseid
//                              ,cs.section as sectionid
//                              ,t.firstname_th as firstname
//                              ,t.lastname_th as lastname
//                              ,co.name as coursename
//                              ,cs.id as id
//                              from course_section cs
//                              left join users t on cs.teacher_id=t.id
//                              left join courses co on cs.course_id=co.id
//                              WHERE  t.role_id=0100
//                              and cs.semester=? and cs.year=?
//                              order by cs.course_id,cs.section
//                              ', array(Session::get('semester'), Session::get('year')));
//        }
//
        return view('home.index',compact('result'));
    }
    public function preview(){
        $course=$_GET['course'];
        $sec=$_GET['sec'];

            $teachers = DB::select('select cs.id as id,tea.id as teacher_id,tea.firstname_th as firstname,tea.lastname_th as lastname
                            from course_section cs
                            LEFT  join users tea on cs.teacher_id=tea.id
                            where cs.semester=? and cs.year=? and cs.course_id=? and cs.section=?', array(Session::get('semester'), Session::get('year'), $course, $sec));
            $ta = DB::select('select ct.id as id,tea.id as ta_id,tea.firstname_th as firstname,tea.lastname_th as lastname
                            from course_ta ct
                            LEFT  join users tea on ct.student_id=tea.id
                            where ct.semester=? and ct.year=? and ct.course_id=? and ct.section=?', array(Session::get('semester'), Session::get('year'), $course, $sec));


            $student = DB::select('select * from users where role_id=0001');
        $homework=DB::select('select * from homework where course_id=? and section=?
                                and semester=? and year=?',array($course,$sec,Session::get('semester'),Session::get('year')));
        $sent=DB::select('select cs.student_id as studentid,stu.firstname_th as firstname,stu.lastname_th as lastname,cs.status as status
                            from course_student cs
                            left join users stu on cs.student_id=stu.id
                           where cs.course_id=? and cs.section=? and cs.semester=? and cs.year=?',
            array($course,$sec,Session::get('semester'),Session::get('year')));
        //return view('homework.resulthomework',compact('homework','sent'))->with('course',array('course'=>$course,'sec'=>$sec));



        return view('home.preview',compact('teachers','ta','student','homework','sent'))->with('course',array('co'=>$course,'sec'=>$sec));

    }
}
