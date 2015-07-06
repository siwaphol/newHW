<?php namespace App\Http\Controllers;

use App\Homework;
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
            $data = \Input::only('sent_data');
            $params = array();
            parse_str($_POST['sent_data'], $params);

            $homework_template = new Homework;
            $homework_template->course_id = $course_id;
            $homework_template->section = $params['section'];
            $homework_template->name = $params['homeworkname'];
            $homework_template->type_id = $params['filetype'];
            $homework_template->detail = $params['filedetail'];
            $homework_template->sub_folder = '.';
            $date = new \DateTime;
            $homework_template->assign_date = $date;
            $homework_template->due_date = $this->convertDatepickerFormat($params['dueDate']);
            $homework_template->accept_date = $this->convertDatepickerFormat($params['acceptUntil']);
            $homework_template->created_by = \Auth::user()->id;
            $homework_template->semester = '1';
            $homework_template->year = '2557';
            $saved = $homework_template->save();

            if(!$saved){
                return "error";
            }
            return "success";
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

}
