@extends('app')

@section('content')
<?php
$assistants=DB::select('select  ta.username as username
                        ,ass.id as id
                        ,ass.student_id as taid
                        ,ta.firstname_th as firstname
                        ,ta.lastname_th as lastname
                        from course_ta ass
                        left join users ta on ass.student_id=ta.id and ta.role_id=0010
                      where ass.course_id=? and  section=?',array($course['co'],$course['sec']));
$count=count($assistants);
$item=$assistants;
?>


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">มอบหมายงานนักศึกษาช่วยสอน</div>
                    
                    <div class="panel-body">
                        <h3 align="center" >กระบวนวิชา {{$course['co']}} ตอน {{$course['sec']}}</h3>
                        <h4><a>{!! link_to_action('AssistantsController@create','เพิ่ม',array('course'=>$course['co'],'sec'=>$course['sec']))!!}</a></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ลำดับ</th><th>ชื่อ นามสกุล</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                <?php
                                for($x=0;$x<$count;$x++){
                                ?>

                                    <tr>
                                        <td>{{ $x+1 }}</td><td><a href="{{ url('/assistants/show', $item[$x]->username) }}">{{ $item[$x]->firstname." ".$item[$x]->lastname }}</a></td>
                                        <td><a>{!! link_to_action('AssistantsController@edit','แก้ไข',array('username'=>$item[$x]->username,'course'=>$course['co'],'sec'=>$course['sec']))!!}</a>
 /                                              <a>{!! link_to_action('AssistantsController@destroy','ลบ',array('id'=>$item[$x]->taid,'course'=>$course['co'],'sec'=>$course['sec']))!!}</a></td>

                                    </tr>
                                    <?php  } ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection