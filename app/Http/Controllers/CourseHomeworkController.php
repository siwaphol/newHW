<?php namespace App\Http\Controllers;

use App\Homework;
use App\HomeworkFolder;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Course;
use DB;
use Session;
use Input;
use Validator;
use Response;

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
        $section_list = DB::select("SELECT section FROM course_section WHERE course_id = ?",[$course_id]);
        $filetype_list = DB::select("SELECT id,extension FROM homework_types");

        return view('teacherhomework.createhomework2',['course_id'=>$course_id,'section_list'=>$section_list,'filetype_list'=>$filetype_list]);
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

    public function result(){
        $course=$_GET['course'];
        $sec=$_GET['sec'];
        $homework=DB::select('select * from homework where course_id=? and section=?
                                and semester=? and year=?',array($course,$sec,Session::get('semester'),Session::get('year')));
        $sent=DB::select('select cs.student_id  from course_student cs
                           where cs.course_id=? and cs.section=? and cs.semester=? and cs.year=?',
                            array($course,$sec,Session::get('semester'),Session::get('year')));
        return view('homework.resulthomework',compact('homework','sent'))->with('course',array('course'=>$course,'sec'=>$sec));

    }

    public function uploadFiles() {

        $input = Input::all();

        $rules = array(
            'file' => 'max:5000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors()->first() , 400);
        }
        $correct_file_name = str_replace('{id}',$input['student_id'],$input['template_name']);
        $user_submitted_file_name= str_replace('.'.Input::file('file')->getClientOriginalExtension() ,'',Input::file('file')->getClientOriginalName());
        $filename_arr = [];

        if($correct_file_name !== $user_submitted_file_name){
            return Response::make("file name is not correct." , 400);
        }

        $extension = DB::select("SELECT extension FROM homework_types WHERE id=?",array($input['type_id']));
        $splited_ext= array();
        if(count($extension)>0){
            $found = false;
            $splited_ext = explode(',',$extension[0]->extension);
            foreach($splited_ext as $aExt){
                array_push($filename_arr, $user_submitted_file_name.'.'.$aExt);
                if(Input::file('file')->getClientOriginalExtension() === $aExt){
                    $found = true;
                }
            }
            if(!$found){
                return Response::make("file extension is not correct." , 400);
            }
        }

        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
//        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $fileName = Input::file('file')->getClientOriginalName();

        $splited_path = explode('/',$input['path']);
        $filename = $destinationPath;
        foreach($splited_path as $aPath){
            $filename = $destinationPath . "/" . $aPath ;
            if (!file_exists($filename)) {
                mkdir($destinationPath . "/" . $aPath, 0777);
            }
            $destinationPath = $destinationPath . "/" . $aPath;
        }
        //Upload file to server
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path

        if ($upload_success) {

            $student_homework = DB::table('homework_student')
                ->where('course_id','=',$input['course_id'] )
                ->where('section','=',$input['section'] )
                ->where('homework_id','=',$input['homework_id'] )
                ->whereIn('homework_name',$filename_arr)
                ->where('semester','=',Session::get('semester') )
                ->where('year','=',Session::get('year') )->get();

            $date = (new \DateTime)->setTimezone(new \DateTimeZone('Asia/Bangkok'))->format('Y-m-d H:i:s');

            $status = '';
            if($date <= $input['due_date'] ){
                $status = '1';
            }
            if($date >= $input['due_date']){
                $status = '2';
            }
            if($date >= $input['accept_date']){
                $status = '3';
            }

            if(count($student_homework) > 0){
                if($student_homework[0]->homework_name !== Input::file('file')->getClientOriginalName()){
                    $filename = $destinationPath.'/'.$student_homework[0]->homework_name;

                    if (\File::exists($filename)) {
                        if(!file_exists('uploads/bin/'.$input['student_id'])){
                            mkdir('uploads/bin/'.$input['student_id'], 0777);
                        }
                        $temp = explode('.',$student_homework[0]->homework_name);
                        $temp_date = (new \DateTime)->setTimezone(new \DateTimeZone('Asia/Bangkok'))->format('Ymd_Hi');
                        \File::move($filename,'uploads/bin/'.$input['student_id'].'/'.$temp[0] .'_'.$temp_date.'.'.$temp[1]);
                        //\File::delete($filename);
                    }

                    $new_file_name = Input::file('file')->getClientOriginalName();
                }else{
                    $new_file_name = $student_homework[0]->homework_name;
                }
                $tempdate = $student_homework[0]->created_at;
                DB::table('homework_student')
                    ->where('course_id','=',$input['course_id'] )
                    ->where('section','=',$input['section'] )
                    ->where('homework_id','=',$input['homework_id'] )
                    ->whereIn('homework_name',$filename_arr)
                    ->where('semester','=',Session::get('semester') )
                    ->where('year','=',Session::get('year') )
                    ->update(['status' => $status,
                        'homework_name' => $new_file_name,
                        'submitted_at' => $date,
                        'created_at' => $student_homework[0]->created_at,
                        'updated_at' => $date]);
            }else{

                DB::table('homework_student')->insert(
                    ['course_id' => $input['course_id'],
                        'section' => $input['section'],
                        'homework_id' => $input['homework_id'],
                        'homework_name' => Input::file('file')->getClientOriginalName(),
                        'student_id' => $input['student_id'],
                        'status' => $status,
                        'submitted_at' => $date,
                        'semester' => Session::get('semester'),
                        'year' => Session::get('year'),
                        'created_at' => $date,
                        'updated_at' => $date]
                );
            }
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function homeworkCreate($course_id){
        $section_list = DB::select("SELECT section FROM course_section WHERE course_id = ? and semester=? and year=?",array($course_id,\Session::get('semester'),\Session::get('year')));
        $filetype_list = DB::select("SELECT id,extension FROM homework_types");
        $homeworks = DB::select("SELECT * FROM homework WHERE course_id=? AND semester=? AND year=?",array($course_id,\Session::get('semester'),\Session::get('year')));
        return view('teacherhomework.createhomework3',['course_id'=>$course_id,'section_list'=>$section_list,'filetype_list'=>$filetype_list,'homeworks'=>$homeworks]);
    }

    public function getHomeworkCreateData($course_id){
        //$homework_status = \Auth::user()->getHomeworkWithStatus('204111','001');

        //new Nong
        $homework_list = new Collection();
        $sections = array();

        $section_list = DB::select("SELECT section FROM course_section WHERE course_id = ? and semester=? and year=?",array($course_id,\Session::get('semester'),\Session::get('year')));
        $homework_by_course = DB::select("SELECT name,section,type_id,assign_date,due_date,accept_date FROM homework
                WHERE course_id=? AND semester=? AND year=? ORDER BY name,section",array($course_id,Session::get('semester'),Session::get('year')));
        $distinct_homework_by_course = DB::select("SELECT DISTINCT name,type_id FROM homework
                WHERE course_id=? AND semester=? AND year=? ORDER BY name,section",array($course_id,Session::get('semester'),Session::get('year')));
        if(count($distinct_homework_by_course)<=0){
            $homework_status = \Datatables::of($homework_list)->make(true);
            return $homework_status;
        }
        $data  = [];
        foreach($distinct_homework_by_course as $aHomework){
            $extension = DB::select("SELECT extension FROM homework_types WHERE id=?",array($aHomework->type_id));
            $type_with_extension =  $extension[0]->extension;
            $obj = new \stdClass;
            $obj->name = $aHomework->name;
            $obj->type_id = $type_with_extension;
            foreach($homework_by_course as $myHomework) {
                if($myHomework->name === $aHomework->name){
                    foreach($section_list as $aSection){
                        if( isset($obj->{'due_date'.$aSection->section}) && $obj->{'due_date'.$aSection->section}!=='' ){
                            continue;
                        }elseif($myHomework->section===$aSection->section &&  !isset($obj->{'due_date'.$aSection->section})){
                            $obj->{'due_date'.$aSection->section} = $myHomework->due_date;
                            $obj->{'accept_until'.$aSection->section} = $myHomework->accept_date;
                        }elseif($myHomework->section===$aSection->section && (isset($obj->{'due_date'.$aSection->section}) && $obj->{'due_date'.$aSection->section}==='') ){
                            $obj->{'due_date'.$aSection->section} = $myHomework->due_date;
                            $obj->{'accept_until'.$aSection->section} = $myHomework->accept_date;
                        }else{
                            $obj->{'due_date'.$aSection->section} = '';
                            $obj->{'accept_until'.$aSection->section} = '';
                        }
                    }
                }
            }

            $data[] = $obj;
        }
        $homework_list = new Collection($data);

//        foreach($distinct_homework_by_course as $aHomework){
//            $extension = DB::select("SELECT extension FROM homework_types WHERE id=?",array($aHomework->type_id));
//            $type_with_extension = $aHomework->type_id . '(' . $extension[0]->extension .')';
//
//            $homework_list->push([
//                'name' => $aHomework->name,
//                'type_id' => $type_with_extension
//            ]);
//
//        }
//        foreach($homework_list as $aHomework){
//            foreach($section_list as $aSection){
//                $testHW = $aHomework;
//                $testHW['due_date'.$aSection->section] = $aHomework->due_date;
//                $testHW['accept_date'.$aSection->section] = $aHomework->accept_date;
//            }
//        }


//        'due_date'.$aHomework->section => $aHomework->due_date,
//        'accept_until'.$aHomework->section => $aHomework->accept_date

        $homework_status = \Datatables::of($homework_list)->make(true);

        return $homework_status;
    }

    public function homeworkPostCreate()
    {
        $input = Input::all();
        $new_input = explode("&",$input['aData']);
        $coure_no = $new_input['course_no'];


        return "success";
    }

}
