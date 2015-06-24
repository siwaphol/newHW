@extends('app')

@section('content')
<?php
$student=DB::select('select * from register re
                      left join students stu on re.studentid=stu.id
                      where re.courseid=? and  re.sectionid=?',array($course['co'],$course['sec']));
$count=count($student);
?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">ข้อมูลนักศึกษา</div>
                    
                    <div class="panel-body">
                        <h1 align="center">กระบวนวิชา {{$course['co']}}  ตอน {{$course['sec']}} </h1>
                        <h2><a href="{{ url('/students/create') }}">เพิ่ม</a></h2>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ลำดับ</th><th>ชื่อ-นามสกุล</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                <?php
                                $item=$student;
                                    for($x=0;$x<$count;$x++){
                                ?>

                                    <tr>
                                        <td>{{ $x }}</td>

                                        <td><a href="{{ url('/students/show', $item[$x]->id) }}">{{ $item[$x]->studentName }}</a></td>
                                        <td><a href="{{ url('/students/edit/',$item[$x]->id) }}">Edit</a> /
                                               <?php
                                               $data=array('id'=>$item[$x]->id,'co'=>$course['co'],'sec'=>$course['sec']);
                                               ?>
                                            {!! Form::open(['method'=>'delete','action'=>['Homework_assignmentController@destroy',$data]]) !!}<button type="submit" class="btn btn-link">Delete</button>{!! Form::close() !!}
                                            </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection