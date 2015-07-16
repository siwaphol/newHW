<?php namespace App\Http\Controllers;

use App\Http\Requests\course_section;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Course_Section as CS;
use Session;
use Illuminate\Http\RedirectResponse;
use App\Course;
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
        //dd($_POST['courseid']);
        $courseid =$_POST['courseid'];
        $sectionid =$_POST['sectionid'];
        $teacherid =$_POST['teacherid'];
        $sql=DB::select('select * from course_section where id=?',array($id));
        $check=DB::select('select tea.firstname_th as firstname,tea.lastname_th as lastname
                          ,cs.course_id as course_id
                          ,cs.section as section
                          from course_section cs
                          left JOIN users tea on cs.teacher_id=tea.id
                          where cs.course_id=? and cs.section=? and cs.teacher_id=?
                          and cs.semester=? and cs.year=?',
                            array($courseid,$sectionid,$teacherid,Session::get('semester'),Session::get('year')));
        if(count($check)>0){
            return redirect()->back()
                ->withErrors(['duplicate' => 'กระบวนวิชา '.$check[0]->course_id.' ตอน '.$check[0]->section.' อาจารย์'.$check[0]->firstname.' '.$check[0]->lastname.' ซ้ำ']);
        }
        $cs = CS::find($id);
//        $cs->course_id=$courseid;
      $cs->section=$sectionid;
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

        //return redirect('course_section');
        return new RedirectResponse(url('home'));
    }
    public function delete(){
            $course=$_GET['course'];
            $sec=$_GET['sec'];
            $id=$_GET['id'];
            $result=DB::delete('delete from course_section where course_id=? and section=?
                                and semester=? and year=? and id=?',array($course,$sec,Session::get('semester'),Session::get('year'),$id));
        //return redirect('course_section');
        return redirect('home');
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

    public function file_get_contents_utf8($fn) {
        $opts = array(
            'http' => array(
                'method'=>"GET",
                'header'=>"Content-Type: text/html; charset=tis-620"
            )
        );

        $context = stream_context_create($opts);
        $result = @file_get_contents($fn,false,$context);
        return $result;
    }
    public function auto(){
        $postdata = http_build_query(
            array(
                'op' => 'precourse',
                'precourse' => '204'
            )
        );
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);
        $semester=Session::get('semester');
        $year=substr(Session::get('year'),-2);
        $result = file_get_contents('https://www3.reg.cmu.ac.th/regist'.$semester.$year.'/public/search.php?act=search', false, $context);
        $line=preg_split("/((\r?\n)|(\r\n?))/", $result);
        $count=count($line);
        $a_cells = array_slice(preg_split('/(?:<\/td>\s*|)<td[^>]*>/', $result), 1);
        $a_cells1 = array_slice(preg_split('/(?:<\/span>\s*|)<span[^>]*>/', $result), 1);
        $n=count($a_cells1);
        $i=2;
        while ($i<$n) {
            $ex=explode( " ", $a_cells1[$i] );

            $course_id=$ex[1];
            $course = substr($a_cells1[$i],12,-10);
            $course = substr($course,0,-14);
            $course = substr($course,4,-1);
            $course=explode( "<",$course);

            $coursename= $course[0];
            //dd($coursename);
            $i=$i+3;
            $co=DB::select('select * from courses where id=?',array($course_id));
            if(count($co)==0){
                $c=new Course();
                $c->id=$course_id;
                $c->name=$coursename;
                $c->save();
            }



        }
        $n=count($a_cells);
        $i=2;
        while ($i<=$n) {
            $name=$a_cells[$i];
            $name = substr($name,1,-1);
          //  dd($coursename);
            $i=$i+1;
            $section=$a_cells[$i];
            if($section=="<gr"){
                $section="000";
            }
            $i=$i+7;

            $ext=explode(" ", $a_cells[$i]);
            $i=$i+12;
            $m=0;
            foreach ($ext as $key => $value) {
                $va[$m]= $value;
                $m++;
            }
            $fname=$va[0];
            if($fname=='<gray>'){
                $fname='staff';
            }
            $ext=explode("<", $va[2]);
            $lname=$ext[0];
            $co=DB::select('select * from courses ');
//dd($name);
//dd($co[0]->name);
            for($v=0;$v<count($co);$v++){
                if($co[$v]->name==$name) {
                    $cid = $co[$v]->id;
                }
            }
            //dd($cid);
            $ck=DB::select('select * from course_section cs
                        where cs.course_id=? and cs.section=?
                          and cs.semester=? and cs.year=?',array($cid,$section,Session::get('semester'),Session::get('year')));
            $id='';
            if(count($ck)==0){
                $ctea=DB::select('select * from users where firstname_en=?
                                and lastname_en=? ',array($fname,$lname));
                if(count($ctea)>0){

                    $id=$ctea[0]->id;
                }

                if(count($ctea)==0){
                    $findid=DB::select('select max(id) as maxid from users where role_id=1000 or role_id=0100');

                    $id=intval($findid[0]->maxid);
                    $id+=1;
                    $id=str_pad($id, 9, "0", STR_PAD_LEFT);
                    $firstname_en=$fname;
                    $lastname_en=$lname;

                    $teacher=DB::insert('insert into users (id,role_id,firstname_en,lastname_en)values(?,?,?,?)',array($id,'0100',$fname,$lname));


                }
//                $co=DB::select('select id from courses where name = ?',array($name));
//                dd($co);
//                for($n1=0;$n1<count($co);$n1++) {
                    $cs = new CS();
                    $cs->course_id = $cid;
                    $cs->section = $section;
                    $cs->teacher_id = $id;
                    $cs->semester = Session::get('semester');
                    $cs->year = Session::get('year');
                    $cs->save();
//                }

            }

        }





        //return   redirect('course');
        return new RedirectResponse(url('home'));
   // return view('course_section.autoinsert');
    }
}
