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
		$students = Students::latest()->get();
		return view('students.index', compact('students'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('students.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Formstudents $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Students::create($request->all());
		return redirect('students');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$student = Students::findOrFail($id);
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
		$student = Students::findOrFail($id);
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
		Students::destroy($id);
        $result=DB::delete('delete from register WHERE courseid=? and sectionid=? and studentid=?',array($course,$sec,$id));

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