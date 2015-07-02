<?php namespace App\Http\Controllers;

use App\Http\Requests\Formstudents;
use App\Http\Controllers\Controller;

use App\Students;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
class StudentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$students =DB::select('select * from users WHERE  role_id=0001');
		//return view('students.index', compact('students'));
        return view('students.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)

	{
        $course=DB::select('select * from course_section where id=?',array($id));
		return view('students.create',compact('course'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Formstudents $request)
	{
		$course_id=$request->get('course_id');
        $section=$request->get('section');
        $student_id=$request->get('student_id');
        $status=$request->get('status');
        $insert=DB::insert('insert into course_student (course_id,section,student_id,status) VALUES (?,?,?,?)',array($course_id,$section,$student_id,$status));
		//return redirect('students/showlist');
        return view('students.showlist')->with('course',array('co'=>$course_id,'sec'=>$section));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//$student = Student::findOrFail($id);
        $student=DB::select('select cs.student_id as student_id
                              ,stu.firstname_th as firstname
                              ,stu.lastname_th as lastname
                              ,stu.email as email
                              ,fac.name_th as faculty
                              from course_student cs
                              left join users stu on cs.student_id=stu.id
                              left join faculties fac on stu.faculty_id=fac.id
                               where (stu.role_id=0001 OR stu.role_id=0011) and cs.student_id=?',array($id));
		return view('students.show', compact('student'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$student=DB::select('select * from users where id=?',array($id));
		return view('students.edit', compact('student'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Formstudents $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$student = Students::findOrFail($id);
		$student->update($request->all());
		return redirect('students');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{   $id=$_POST['id'];
        $course=$_POST['course'];
        $sec=$_POST['sec'];
		//Students::destroy($id);
        $result1=DB::delete('delete from users where id=?',array($id));
        $result=DB::delete('delete from course_student WHERE course_id=? and section=? and student_id=?',array($course,$sec,$id));

		return redirect('students');
	}
    public function import()
    {

        return view('students.selectcourse_section');
    }
    public function manualimport()
    {

        return view('students.selectmanualcourse_section');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert()
    {
        $course = $_POST['ddlCourse'];
        $sec = $_POST['ddlSection'];
        $cours=array('co'=>$course,'sec'=>$sec);
        //return $cours;
        return view('students.insert')->with('cours',$cours);
    }
    public function showlist()
    {
        $course = $_POST['ddlCourse'];
        $sec = $_POST['ddlSection'];
        $cours=array('co'=>$course,'sec'=>$sec);
        //return $cours;
        return view('students.showlist')->with('course',$cours);
    }
    public function export(){
        $course=$_POST['course'];
        $sec=$_POST['sec'];

        return view('students.export')->with('course',array('co'=>$course,'sec'=>$sec));
    }
    public function manualinsert()
    {
        $course = $_POST['ddlCourse'];
        $sec = $_POST['ddlSection'];
        $fileupload_name=$_FILES['fileupload']['name'];
        $cours=array('co'=>$course,'sec'=>$sec,'fileupload'=>$fileupload_name);
        //return $cours;
        return view('students.manualinsert')->with('cours',$cours);
    }
    public function autoimport()
    {

        return view('students.autoinsert');
    }
}