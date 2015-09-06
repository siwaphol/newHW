<?php namespace App\Http\Controllers;

use App\Http\Requests\course_section;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Course_Section as CS;
use Illuminate\Support\Collection;
use Log;
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
    /**
     * @input text from web page (not html value)
     * @return collection of all course
     */
//    protected function turnHTMLtoCollection($courseArray){
//        //Assumming first line is "204100 - IT AND MODERN LIFE (11 Sections)"
//        $regex_for_course_no = '/204[0-9]{3}/';
//        $regex_for_course_name = '/-(.*?)\(/';
//        $regex_for_sections = '/\((.*?)\)/';
//        $result_collection = array();
//
//        foreach($courseArray as $aCourse){
//            preg_match($regex_for_course_no, $aCourse, $match);
//            $course_no = $match[0];
//            preg_match($regex_for_course_name, $aCourse, $match);
//            $course_name = trim($match[1]);
//            preg_match($regex_for_sections, $aCourse, $match);
//            $temp = explode(' ',$match[1]);
//            $section_count = $temp[0];
//
//            preg_match_all('/'.$course_name.'\b.*$/m',$aCourse,$all_lines_contain_course_name);
//
//            //Assume each line will be like "$course_name 001000"
//            array_shift($all_lines_contain_course_name[0]);
//            array_push($result_collection,$all_lines_contain_course_name[0]);
//        }
//
//        dd($result_collection);
//        return false;
//    }
    protected function turnHTMLtoCollection($courseArray){

    }

    protected function getTeacherName($inputString)
    {
        //<td in title="
        $inputString = str_replace('<br>','&',$inputString);
        $inputString = str_replace('</br>','&',$inputString);
        $inputString = str_replace('<b>co-instructor</b>','&',$inputString);

        $found_name_th = false;
        $f_index = strpos($inputString,'<td in title=');
        $pos = $f_index;
        $stringArray = str_split($inputString);
        $a_tag = '';
        $teacher_name_th = '';
        $teacher_name_en = '';
        while($a_tag !== '</td>'){
            if(substr($a_tag,-1) === '>'){
                $a_tag='';
            }
            if($stringArray[$pos]=== '<'){
                $teacher_name_en = $a_tag;
                $a_tag = '';
            }
            $a_tag .= $stringArray[$pos];
            if($stringArray[$pos]==='"' && !$found_name_th){
                $pos = $pos + 1;
                while($stringArray[$pos]!=='"'){
                    $teacher_name_th .= $stringArray[$pos];
                    $a_tag .= $stringArray[$pos];
                    $pos = $pos + 1;
                }
                $a_tag .= $stringArray[$pos]; //closing "
                $found_name_th = true;
            }

            $pos = $pos+1;
        }
        return array('teacher_name_th'=>$teacher_name_th,'teacher_name_en'=>$teacher_name_en);
    }
    public function auto(){
        $regex_for_course_no = '/204[0-9]{3}/';
//        $one_course_array = array('id'=>'204111','sections'=>array(array('no'=>'001'),array('no'=>'002')));
//        array_push($one_course_array['sections'],array('no'=>'oh my god'));
//        $collection = array();
//        array_push($collection,$one_course_array);
//        dd($collection);

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
        //test
        $year='58';
        //end test
        $result = file_get_contents('https://www3.reg.cmu.ac.th/regist'.$semester.$year.'/public/search.php?act=search', false, $context);

        $e_result = explode('<span coursetitle>',$result);
        array_shift($e_result);
        $all_courses_array = array();

        //test
//        dd($e_result);
        foreach($e_result as $aCourse){
            //for closed course will be <tr coursedata close>
            $e2_result= explode('<tr coursedata',$aCourse);
//            dd($e2_result);
            preg_match('/([0-9]{6}) - (.*?) \(([0-9]{1,2}) Section[s]?\)/',strip_tags($e2_result[0]),$matches);
            $a_course_array = array();
            if(count($matches)==4){
                $course_no = $matches[1];
                $course_name = $matches[2];
                $course_section_count = $matches[3];
                //array_push($a_course_array,['id'=>$course_no],['name'=>$course_name],['sections'=>array()]);
                $a_course_array = array('id'=>$course_no,'name'=>$course_name,'sections'=>array());
                try {
                    Course::findOrFail($course_no);
                }catch (ModelNotFoundException $e){
                    Log::info($e->getMessage() . '\nNew Course was created: ' .$course_no.' '.$course_name);
                    $new_course = new Course();
                    $new_course->id = $course_no;
                    $new_course->name = ucwords($course_name);
                    $new_course->save();
                }
            }else{
                Log::error('Cannot find course details in this block of text: ' . strip_tags($e2_result[0]));
                continue;
            }
            array_shift($e2_result);

            foreach ($e2_result as $aSection) {
                $a_section_array = array();
                preg_match('/SECLEC=([0-9]{3})&SECLAB=([0-9]{3})/', $aSection, $section_matches);
                if(count($section_matches)==3) {
                    if ($section_matches[1] === '000') {
                        $course_sec = $section_matches[2];
                    } else {
                        $course_sec = $section_matches[1];
                    }
                    $a_section_array = array_add($a_section_array,'no',$course_sec);
                    //array_push($a_section_array,'no'=>$course_sec);
                }else{
                    Log::error('Cannot find course section in this block of text: ' . $aSection);
                    continue;
                }
//                preg_match('/<td in title="(.*)">(.*)<\/td>/', $aSection, $section_teacher);
                $teacher_names = $this->getTeacherName($aSection);

//                preg_match('/<td in title="(.*)">[a-zA-Z| ]*<\/td>/u', $aSection, $section_teacher);
//                if(count($section_teacher)==3) {
//                    $section_teacher_th = trim($section_teacher[1]);
//                    $section_teacher_en = trim($section_teacher[2]);
//                    $a_section_array = array_add($a_section_array,'teacher_name_th',$section_teacher_th);
//                    $a_section_array = array_add($a_section_array,'teacher_name_en',$section_teacher_en);
//                }else{
//                    Log::error('Cannot find course teacher(s) in this block of text: ' . $aSection);
//                    continue;
//                }
                $a_section_array = array_add($a_section_array,'teacher_name_th',$teacher_names['teacher_name_th']);
                $a_section_array = array_add($a_section_array,'teacher_name_en',$teacher_names['teacher_name_en']);
                //push one section to course
                array_push($a_course_array['sections'],$a_section_array);
            }
            //push one course to all courses array
            array_push($all_courses_array,$a_course_array);

        } //end foreach foreach($e_result as $aCourse)
        //end test
        dd($all_courses_array);
//        $e2_result= explode('<tr coursedata >',$e_result[0]);
//        array_shift($e2_result);
//        preg_match('/<td left>(.*?)<\/td>/',$e2_result[0],$matches);
//        $course_name = trim($matches[1]);
//        preg_match('/SECLEC=([0-9]{3})&SECLAB=([0-9]{3})/',$e2_result[0],$section_matches);
//        if($section_matches[1]==='000'){
//            $course_sec = $section_matches[2];
//        }else{
//            $course_sec = $section_matches[1];
//        }
//        preg_match('/<td in title="(.*)">(.*)<\/td>/',$e2_result[0],$section_teacher);
//        $section_teacher_th = $section_teacher[1];
//        $section_teacher_en = $section_teacher[2];
        dd('Aha its here now');

        preg_match_all('/<tr coursedata >(.|\s)*<\/tr>$/',$e_result[0],$matches);
        dd($matches);
        $course_array = explode('•',strip_tags($result));
        array_shift($course_array);
        $course_array = array_map('trim',$course_array);
        //loop start from now
        //preg_match($regex_for_course_no,$course_array[0],$match);
        $courseCollection = $this->turnHTMLtoCollection($course_array);

        dd('testSiwaphol');

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
            //$exp=explode('<gray>',$section);
            //$a = array_slice(preg_split('/(?:<\/gray>\s*|)<gray[^>]*>/', $section), 1);
            $l=strlen($section);
            if($l>3){
                $section='000';
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
