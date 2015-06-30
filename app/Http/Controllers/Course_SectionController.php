<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class Course_SectionController extends Controller
{

    //
    public function index()
    {
        $result = DB::select('select cs.course_id as courseid
                              ,cs.section as sectionid
                              ,t.firstname_th as firstname
                              ,t.lastname_th as lastname
                              ,co.name as coursename
                              from course_section cs
                              left join users t on cs.teacher_username=t.username
                              left join courses co on cs.course_id=co.id
                              WHERE  t.role_id=0100
                              order by cs.course_id,cs.section
                              ');

        return view('course_section.index', compact('result'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $courseid = $_GET['course'];
        $sectionid = $_GET['sec'];
        $result = DB::select('select cs.course_id as courseid
                              ,cs.section as sectionid
                              ,t.firstname_th as firstname
                              ,t.lastname_th as lastname
                              ,co.name as coursename
                              ,cs.teacher_username as teacherid
                              from course_section cs
                              left join users t on cs.teacher_username=t.username
                              left join courses co on cs.course_id=co.id
                              where cs.course_id=? and cs.section=?
                              ', array($courseid, $sectionid));

        return view('course_section.edit', compact('result'));
    }

    public function update()
    {

        $courseid = $_POST['courseid'];
        $sectionid =$_POST['sectionid'];
        $teacherid =$_POST['teacherid'];
        $course = DB::update('update course_section set course_id=?,section=?,teacher_username=? where course_id=? and section=?', array($courseid, $sectionid, $teacherid, $courseid, $sectionid));
        return redirect('course_section');
    }

    public  function create(){

        return view('course_section.create');
    }
    public function store(Request $request)
    {
         $courseid = $_POST['courseid'];
        $sectionid = $_POST['sectionid'];
        $teacherid = $_POST['teacherid'];
        $Course = DB::insert('insert into course_section(course_id,section,teacher_username)VALUES (?,?,?)', array($courseid, $sectionid, $teacherid));
        return redirect('course_section');
    }
    public function delete(){
            $course=$_GET['course'];
            $sec=$_GET['sec'];
            $result=DB::delete('delete from course_section where course_id=? and section=?',array($course,$sec));
        return redirect('course_section');
    }
}
