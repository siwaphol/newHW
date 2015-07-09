<?php namespace App\Http\Controllers;

use App\Http\Requests\course_section;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Course_Section as CS;
use Session;
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
                              ,cs.id as id
                              from course_section cs
                              left join users t on cs.teacher_id=t.id
                              left join courses co on cs.course_id=co.id
                              WHERE  t.role_id=0100
                              and cs.semester=? and cs.year=?
                              order by cs.course_id,cs.section
                              ',array(Session::get('semester'),Session::get('year')));

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
        $result = DB::select('select cs.id as id
                              ,cs.course_id as courseid
                              ,cs.section as sectionid
                              ,t.firstname_th as firstname
                              ,t.lastname_th as lastname
                              ,co.name as coursename
                              ,cs.teacher_id as teacherid
                              from course_section cs
                              left join users t on cs.teacher_id=t.id
                              left join courses co on cs.course_id=co.id
                              where cs.course_id=? and cs.section=? and cs.semester=? and cs.year=?
                              ', array($courseid, $sectionid,Session::get('semester'),Session::get('year')));

        return view('course_section.edit', compact('result'));
    }

    public function update()
    {
        $id=$_POST['id'];
        //$courseid =$_POST['courseid'];
       // $sectionid =$_POST['sectionid'];
        $teacherid =$_POST['teacherid'];
        $sql=DB::select('select * from course_section where id=?',array($id));
        $check=DB::select('select tea.firstname_th as firstname,tea.lastname_th as lastname
                          ,cs.course_id as course_id
                          ,cs.section as section
                          from course_section cs
                          left JOIN users tea on cs.teacher_id=tea.id
                          where cs.course_id=? and cs.section=? and cs.teacher_id=?
                          and cs.semester=? and cs.year=?',
                            array($sql[0]->course_id,$sql[0]->section,$teacherid,Session::get('semester'),Session::get('year')));
        if(count($check)>0){
            return redirect()->back()
                ->withErrors(['duplicate' => 'กระบวนวิชา '.$check[0]->course_id.' ตอน '.$check[0]->section.' อาจารย์'.$check[0]->firstname.' '.$check[0]->lastname.' ซ้ำ']);
        }
        $cs = CS::find($id);
//        $cs->course_id=$courseid;
//        $cs->section=$sectionid;
        $cs->teacher_id=$teacherid;
        $cs->save();
        // $course = DB::update('update course_section set course_id=?,section=?,teacher_id=? where course_id=? and section=?', array($courseid, $sectionid, $teacherid, $courseid, $sectionid));
        return redirect('home');
    }

    public  function create(){

        return view('course_section.create');
    }

    /**
     * @param course_section $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(course_section $request)
    {
         $courseid = $request->get('courseid');
        $sectionid = $request->get('sectionid');
        $teacherid = $request->get('teacherid');
        $check=DB::select('select tea.firstname_th as firstname,tea.lastname_th as lastname from course_section cs
                          left JOIN users tea on cs.teacher_id=tea.id
                          where cs.course_id=? and cs.section=? and cs.teacher_id=?
                          and cs.semester=? and cs.year=?',array($courseid,$sectionid,$teacherid,Session::get('semester'),Session::get('year')));

        if(count($check)>0){
            return redirect()->back()
                ->withErrors(['duplicate' => 'กระบวนวิชา '.$courseid.' ตอน '.$sectionid.' อาจารย ์'.$check[0]->firstname.' '.$check[0]->lastname.' ซ้ำ']);
        }

        $cs=new CS();
        $cs->course_id=$courseid;
        $cs->section=$sectionid;
        $cs->teacher_id=$teacherid;
        $cs->semester=Session::get('semester');
        $cs->year=Session::get('year');
        $cs->save();

        //$Course = DB::insert('insert into course_section(course_id,section,teacher_id)VALUES (?,?,?)', array($courseid, $sectionid, $teacherid));

        return redirect('course_section');
    }
    public function delete(){
            $course=$_GET['course'];
            $sec=$_GET['sec'];
            $id=$_GET['id'];
            $result=DB::delete('delete from course_section where course_id=? and section=?
                                and semester=? and year=? and id=?',array($course,$sec,Session::get('semester'),Session::get('year'),$id));
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
    public function selectcreate(){

        return view('course_section.selectcreate');
    }
    public function createteacher(){
        $courseid=$_POST['courseid'];
        $section=$_POST['sectionid'];
        return view('course_section.createteacher')->with('course',array('co'=>$courseid,'sec'=>$section));
    }
    public function saveteacher(){

        $courseid=$_POST['courseid'];
        $sectionid=$_POST['sectionid'];
        $teacherid=$_POST['teacherid'];
        $count=count($sectionid);


        for($i=0;$i<$count;$i++) {

            $check = DB::select('select tea.firstname_th as firstname,tea.lastname_th as lastname from course_section cs
                          left JOIN users tea on cs.teacher_id=tea.id
                          where cs.course_id=? and cs.section=? and cs.teacher_id=?
                          and cs.semester=? and cs.year=?', array($courseid, $sectionid[$i], $teacherid[$i], Session::get('semester'), Session::get('year')));

            if (count($check) == 0) {
            $cs = new CS();
            $cs->course_id = $courseid;
            $cs->section = $sectionid[$i];
            $cs->teacher_id = $teacherid[$i];
            $cs->semester = Session::get('semester');
            $cs->year = Session::get('year');
            $cs->save();
            }

        }

        return redirect('course_section');
    }
}
