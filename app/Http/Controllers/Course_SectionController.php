<?php namespace App\Http\Controllers;

use App\Http\Requests\course_section;
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
                              left join users t on cs.teacher_id=t.id
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
                              ,cs.teacher_id as teacherid
                              from course_section cs
                              left join users t on cs.teacher_id=t.id
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
        $course = DB::update('update course_section set course_id=?,section=?,teacher_id=? where course_id=? and section=?', array($courseid, $sectionid, $teacherid, $courseid, $sectionid));
        return redirect('course_section');
    }

    public  function create(){

        return view('course_section.create');
    }
    public function store(course_section $request)
    {
         $courseid = $request->get('courseid');
        $sectionid = $request->get('sectionid');
        $teacherid = $request->get('teacherid');
        $check=DB::select('select tea.firstname_th as firstname,tea.lastname_th as lastname from course_section cs
                          left JOIN users tea on cs.teacher_id=tea.id
                          where cs.course_id=? and cs.section=? and cs.teacher_id=?',array($courseid,$sectionid,$teacherid));

        if(count($check)>0){
            return redirect()->back()
                ->withErrors(['duplicate' => 'กระบวนวิชา '.$courseid.' ตอน '.$sectionid.' อาจารย ์'.$check[0]->firstname.' '.$check[0]->lastname.' ซ้ำ']);
        }
        $Course = DB::insert('insert into course_section(course_id,section,teacher_id)VALUES (?,?,?)', array($courseid, $sectionid, $teacherid));

        return redirect('course_section');
    }
    public function delete(){
            $course=$_GET['course'];
            $sec=$_GET['sec'];
            $result=DB::delete('delete from course_section where course_id=? and section=?',array($course,$sec));
        return redirect('course_section');
    }
    public function check(){
        $course = $_POST['course'];
        $sec = $_POST['sec'];

        $result=DB::select('select * from course_section where course_id=? and section=? ',array($course,$sec));
       dd($result);
        $count=count($result);
        if($count>0){
            return 0;

        }else{
            return 1;
        }


    }
}
