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
        $result = DB::select('select cs.courseid as courseid
                              ,cs.sectionid as sectionid
                              ,t.teachername as teachername
                              ,co.coursename as coursename
                              from course_section cs
                              left join ีt on cs.teacherid=t.id
                              left join courses co on cs.courseid=co.id
                              ');

        return view('course_section.index', compact('result'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $courseid = substr($id, 0, 6);
        $sectionid = substr($id, 6, 9);
        $result = DB::select('select cs.courseid as courseid
                              ,cs.sectionid as sectionid
                              ,t.teachername as teachername
                              ,co.coursename as coursename
                              ,cs.teacherid as teacherid
                              from course_section cs
                              left join teachers t on cs.teacherid=t.id
                              left join courses co on cs.courseid=co.id
                              where cs.courseid=? and cs.sectionid=?
                              ', array($courseid, $sectionid));

        return view('course_section.edit', compact('result'));
    }

    public function update()
    {

        $courseid = Request::get('courseid');
        $sectionid = Request::get('sectionid');
        $teacherid = Request::get('teacherid');
        $Course = DB::update('update course_section set courseid=?,sectionid=?,teacherid=? where courseid=? and sectionid=?', array($courseid, $sectionid, $teacherid, $courseid, $sectionid));
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
        $Course = DB::insert('insert into course_section(courseid,sectionid,teacherid)VALUES (?,?,?)', array($courseid, $sectionid, $teacherid));
        return redirect('course_section');
    }

}
