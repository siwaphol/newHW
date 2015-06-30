<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Assistants;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AssistantsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view('assistants.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('assistants.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $course=$_POST['courseId'];
        $sec=$_POST['sectionId'];
        $ta_username=$_POST['taId'];
        $result=DB::insert('insert into course_ta');
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Assistants::create($request->all());
		return redirect('assistants');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $assistant=DB::select('select ta.student_id as student_id, ta.username as tausername,ta.firstname_th as firstname,ta.lastname_th as lastname ,ass.course_id as courseid,ass.section as sectionid
                                from course_ta ass
                                left join users ta on ass.ta_username=ta.username
                                 where ta.username=?',array($id));
		//$assistant = Assistants::findOrFail($id);
		return view('assistants.show')->with('assistant',$assistant);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
        $course=$_GET['course'];
        $sec=$_GET['sec'];
        $ta_username=$_GET['username'];
        $assistant=DB::select('select st.course_id as course_id
                                ,st.section as section
                                ,ta.student_id as student_id
                                ,ta.firstname_th as firstname
                                ,ta.lastname_th as lastname
                                from course_ta st
                                left join users ta on st.ta_username=ta.username
                                where st.course_id=? and st.section=? and st.ta_username=?',array($course,$sec,$ta_username));
		//$assistant = Assistants::findOrFail($id);
		return view('assistants.edit', compact('assistant'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
        $course_id=$_POST['course_id'];
        $section=$_POST['section'];
        $student_id=$_POST['student_id'];
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$assistant = Assistants::findOrFail($id);
		$assistant->update($request->all());
		return redirect('assistants');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
        $course=$_GET['course'];
        $sec=$_GET['sec'];
        $ta_username=$_GET['username'];
		$result=DB::delete('delete from course_ta where course_id=? and section=? and ta_username=?',array($course,$sec,$ta_username));
		return redirect('assistants');
	}
    public function showlist()
    {
        $course = $_POST['ddlCourse'];
        $sec = $_POST['ddlSection'];
        $cours=array('co'=>$course,'sec'=>$sec);
        //return $cours;
        return view('assistants.showlist')->with('course',$cours);
    }
}