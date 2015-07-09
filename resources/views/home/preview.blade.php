
@extends('app')
@section('content')


  <script type="text/javascript">

$(document).ready(function() {
    $('#example').dataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );

    </script>
<?php  $i=1;
              $coid=DB::select('select * from course_section c where c.course_id=? and c.section=? and c.semester=? and c.year=?',array($course['co'],$course['sec'],Session::get('semester'),Session::get('year')));?>

<div >

 <h3 align="center">กระบวนวิชา {{$course['co']}}  ตอน {{$course['sec']}} </h3>
  <!-- Nav tabs -->
</div>
<h4 align="center"> อาจารย์ผู้สอน </h4>
@foreach($teachers as $item)
<h5 align="center">{{$item->firstname.' '.$item->lastname}} </h5>
@endforeach
<h4 align="center"> นักศึกษาช่วยสอน</h4>
@foreach($ta as $item)
<h5 align="center">{{$item->firstname.' '.$item->lastname.'   '.$item->ta_id}} </h5>
@endforeach
<div class="col-md-10 col-md-offset-2">
@if(Auth::user()->isAdmin() || Auth::user()->isTeacher())
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
   <a>เพิ่มนักศึกษา</a>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><button type="button" class="btn btn-default">{!! link_to_action('StudentsController@insert','เพิ่มรายชื่อนักศึกษาจากสำนักทะเบียน',array('ddlCourse'=>$course['co'],'ddlSection'=>$course['sec']))!!}</button>
    </li>
    <li><button type="button" class="btn btn-default">{!! link_to_action('StudentsController@selectexcel','เพิ่มรายชื่อนักศึกษาจากไฟล์ Excel',array('ddlCourse'=>$course['co'],'ddlSection'=>$course['sec']))!!}</button>
    </li>
    <li><a href="{{ url('/students/create/'.$coid[0]->id) }}"class="btn btn-default">เพิ่มนักศึกษารายบุคคล</a></li>

  </ul>
</div>
{{--<button type="button" class="btn btn-default">{!! link_to_action('StudentsController@insert','เพิ่มรายชื่อนักศึกษาจากสำนักทะเบียน',array('ddlCourse'=>$course['co'],'ddlSection'=>$course['sec']))!!}</button>--}}
{{--<button type="button" class="btn btn-default">{!! link_to_action('StudentsController@selectexcel','เพิ่มรายชื่อนักศึกษาจากไฟล์ Excel',array('ddlCourse'=>$course['co'],'ddlSection'=>$course['sec']))!!}</button>--}}
<button type="button" class="btn btn-default">{!! link_to_action('AssistantsController@create','เพิ่มนักศึกษาช่วยสอน',array('course'=>$course['co'],'sec'=>$course['sec']))!!}</button>
<button type="button" class="btn btn-default">{!! link_to_action('StudentsController@export','Export CSV',array('course'=>$course['co'],'sec'=>$course['sec']))!!}</button>
<button type="button" class="btn btn-default">{!! link_to_action('AssistantsController@create','จัดการการบ้าน',array('course'=>$course['co'],'sec'=>$course['sec']))!!}</button>
<button type="button" class="btn btn-default">{!! link_to_action('StudentsController@export','ผลการส่งการบ้าน',array('course'=>$course['co'],'sec'=>$course['sec']))!!}</button>
@endif
</div>


<?php
            $student=DB::select('select re.student_id as studentid,stu.firstname_th as firstname_th,stu.lastname_th as lastname_th,re.status as status
                                  from course_student  re
                                  left join users stu on re.student_id=stu.id
                                  where re.course_id=? and  re.section=? and re.semester=? and re.year=?
                                  order by re.student_id
                                  ',array($course['co'],$course['sec'],Session::get('semester'),Session::get('year')));
            $count=count($student);

            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="panel panel-default">
                                {{--<div class="panel-heading" align="center">ข้อมูลนักศึกษา</div>--}}

                                <div class="panel-body">
                                    {{--<h3 align="center">กระบวนวิชา {{$course['co']}}  ตอน {{$course['sec']}} </h3>--}}
                                     <h4 align="center">รายชื่อนักศึกาษา </h4>

                                    {{--<h4><a href="{{ url('/students/create/'.$coid[0]->id) }}">เพิ่มนักศึกษา</a></h4>--}}

                                     {{--{!! Form::open(['url' => 'students/export']) !!}--}}

                                      {{--<input type="hidden" name="course" id="course" value='{{$course['co']}}'>--}}
                                      {{--<input type="hidden" name="sec" id="sec" value='{{$course['sec']}}'>--}}

                                      {{--<button type="submit" class="btn btn-link">export csv</button>--}}
                                       {{--{!! Form::close() !!}--}}
                                    <div class="table-responsive">
                                        <table class="table" id="example" cellspacing="0" width="100%" >
                                           <thead>
                                            <tr>
                                                <th>รหัสนักศึกษา</th><th>ชื่อ-นามสกุล</th><th>สถานะ</th><th>delete</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>รหัสนักศึกษา</th><th>ชื่อ-นามสกุล</th><th>สถานะ</th><th>delete</th>
                                            </tr>
                                            </tfoot>
                                            {{-- */$x=0;/* --}}
                                            <tbody>
                                            <?php
                                            $item=$student;
                                                for($x=0;$x<$count;$x++){
                                            ?>

                                                <tr>

                                                    <td><a href="{{ url('/students/show', $item[$x]->studentid) }}">{{ $item[$x]->studentid }}</a></td>
                                                    <td><a href="{{ url('/students/show', $item[$x]->studentid) }}">{{ $item[$x]->firstname_th." ".$item[$x]->lastname_th }}</a></td>
                                                    <td>{{ $item[$x]->status}}</td>
                                                    <!--
                                                    <td><a href="{{ url('/students/edit/'.$item[$x]->studentid) }}">Edit</a> </td>
                                                    -->
                                                    <td>
                                                           <?php
                                                           $data=array('id'=>$item[$x]->studentid,'co'=>$course['co'],'sec'=>$course['sec']);
                                                           ?>
                                                        {!! Form::open(['url' => 'students/delete']) !!}

                                                        <input type="hidden" name="course" id="course" value='{{$course['co']}}'>
                                                        <input type="hidden" name="sec" id="sec" value='{{$course['sec']}}'>
                                                        <input type="hidden" name="id" id="id" value='{{$item[$x]->studentid}}'>
                                                        <button type="submit" class="btn btn-danger btn-ok" onclick="return confirm('Are you sure you want to delete?')">Delete</button>

                                                        {!! Form::close() !!}

                                                         {{--<td>{!! link_to_action('StudentsController@destroy','ลบ',array('id'=>$item[$x]->studentid,'course'=>$course['co'],'sec'=>$course['sec']),onclick="return confirm('Are you sure you want to delete?')")!!}</td>--}}

                                                        </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





@endsection