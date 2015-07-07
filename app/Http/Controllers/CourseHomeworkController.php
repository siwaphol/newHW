<?php namespace App\Http\Controllers;

use App\Homework;
use App\HomeworkFolder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Course;
use DB;

class CourseHomeworkController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($course_id)
	{
        return view('teacherhomework.createhomework2',['course_id'=>$course_id]);
	}

    public function create_post($course_id){

        if(\Request::ajax()) {
            if(\Input::get('method') == 'add'){
                if(\Input::has('new_file')) {
                    $params = array();
                    parse_str($_POST['new_file'], $params);

                    $homework_template = new Homework;
                    $homework_template->course_id = $course_id;
                    $homework_template->section = $params['section'];
                    $homework_template->name = $params['homeworkname'];
                    $homework_template->type_id = $params['filetype'];
                    $homework_template->detail = $params['filedetail'];
                    $homework_template->path = '.';
                    $date = new \DateTime;
                    $homework_template->assign_date = $date;
                    $homework_template->due_date = $this->convertDatepickerFormat($params['dueDate']);
                    $homework_template->accept_date = $this->convertDatepickerFormat($params['acceptUntil']);
                    $homework_template->created_by = \Auth::user()->id;
                    $homework_template->semester = \Session::get('semester');
                    $homework_template->year = \Session::get('year');
                    $saved = $homework_template->save();

                    if (!$saved) {
                        return "error";
                    }
                    return "success";
                }else if(\Input::has('new_folder')){
                    $params = array();
                    parse_str($_POST['new_folder'], $params);

                    $hw_folder_template = new HomeworkFolder;
                    $hw_folder_template->course_id = $course_id;
                    $hw_folder_template->section = $params['folderSection'];
                    $hw_folder_template->name = $params['folderName'];
                    $hw_folder_template->path = '.';
                    $hw_folder_template->semester = \Session::get('semester');
                    $hw_folder_template->year = \Session::get('year');
                    $saved = $hw_folder_template->save();

                    if (!$saved) {
                        return "error";
                    }
                    return "success";
                }
            }else if(\Input::get('method') == 'edit'){

            }
        }
        return "error";
    }
    public function create_get_long($course_id,$path){
        $_GET['path'] = $path;
        return view('teacherhomework.createhomework2',['course_id'=>$course_id]);
    }
    public function create_post_long($course_id,$path){
        if(\Request::ajax()) {
            if(\Input::has('new_file')) {
                $params = array();
                parse_str($_POST['new_file'], $params);

                $homework_template = new Homework;
                $homework_template->course_id = $course_id;
                $homework_template->section = $params['section'];
                $homework_template->name = $params['homeworkname'];
                $homework_template->type_id = $params['filetype'];
                $homework_template->detail = $params['filedetail'];
                $homework_template->path = './' . $path;
                $date = new \DateTime;
                $homework_template->assign_date = $date;
                $homework_template->due_date = $this->convertDatepickerFormat($params['dueDate']);
                $homework_template->accept_date = $this->convertDatepickerFormat($params['acceptUntil']);
                $homework_template->created_by = \Auth::user()->id;
                $homework_template->semester = \Session::get('semester');
                $homework_template->year = \Session::get('year');
                $saved = $homework_template->save();

                if(!$saved){
                    return "error";
                }
                return "success";
            }else if(\Input::has('new_folder')){
                $params = array();
                parse_str($_POST['new_folder'], $params);

                $hw_folder_template = new HomeworkFolder;
                $hw_folder_template->course_id = $course_id;
                $hw_folder_template->section = $params['folderSection'];
                $hw_folder_template->name = $params['folderName'];
                $hw_folder_template->path = './' . $path;
                $hw_folder_template->semester = \Session::get('semester');
                $hw_folder_template->year = \Session::get('year');
                $saved = $hw_folder_template->save();

                if (!$saved) {
                    return "error";
                }
                return "success";
            }
        }
        return "error";
    }
    //accept input date as 06%2F07%2F2015+11%3A59+AM from serialized string
    protected  function convertDatepickerFormat($date){
        $parts = explode(' ',$date);

        $date = explode('/',$parts[0]);
        $result = $date[2] . '-' . $date[1] . '-' . $date[0] . ' ';

        $time = explode(':',$parts[1]);
        if($parts[2] === 'PM' && intval($time[0]) != 12){
            $time[0] = strval(intval($time[0]) + 12);
        }else if($parts[2] === 'AM' && intval($time[0]) == 12){
            $time[0] = '00';
        }
        $result = $result . $time[0] . ':' . $time[1] . ':' . '00';

        return $result;
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $course_id
	 * @return Response
	 */
	public function show($course_id)
	{
		$course = Course::findOrFail($course_id);

        dd($course->courseName);

        return view('homework.show', compact('course'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function result($id){

        $homework=DB::select('select * from homework where course_id=204111 and section=001');
        $sent=DB::select('select cs.student_id  from homework_student hs
                          right join course_student cs on hs.student_id=cs.student_id

                           where cs.course_id=204111 and cs.section=001');
        return view('homework.resulthomework',compact('homework','sent'));

    }

}
