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
<h1 align="center">แก้ไขตอน</h1>
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
  {!! Form::submit('update',['class'=>'btn btn-primary form-control'])!!}
  </div>

  {!! Form::close() !!}
@endforeach


  @endsection