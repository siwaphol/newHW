<?php
/**
 * Created by PhpStorm.
 * User: boonchuay
 * Date: 19/6/2558
 * Time: 10:53
 */
 ?>
@extends('app');
@section('content')
<?php


?>

<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">แก้ไขตอ</div>

                    <div class="panel-body">
@foreach($result as $key)
  {!! Form::open(['url'=>'course_section/update']) !!}
  <div class="form-group">
  {!! Form::label('id','รหัส')!!}
  {!! Form::text('id',$key->courseid,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
  {!! Form::label('courseName','ชื่อกระบวนวิชา')!!}
  {!! Form::text('courseName',$key->coursename,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
  {!! Form::label('sectionid','ตอน')!!}
  {!! Form::text('sectionid',$key->sectionid,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
  {!! Form::label('teachername','อาจารย์')!!}
  {!! Form::text('teachername',$key->teachername,['class'=>'form-control'])!!}
  {!! Form::hidden('teacherid',$key->teachername,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
  {!! Form::submit('ปรับปรุง',['class'=>'btn btn-primary form-control'])!!}
  </div>

  {!! Form::close() !!}
  </div>
  </div>
  </div>
  </div>
  </div>

@endforeach


  @endsection