
@extends('app');
@section('content')
<?php
$key=$course;
?>
<h1 align="center">แก้ไขกระบวนวิชา</h1>
{!! Form::open(['url'=>'course/saveedit']) !!}
<div class="form-group">
{!! Form::label('id','รหัส')!!}
{!! Form::text('id',$course->id,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::label('courseName','ชื่อกระบวนวิชา')!!}
{!! Form::text('courseName',$course->courseName,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::submit('addcourse',['class'=>'btn btn-primary form-control'])!!}
</div>

{!! Form::close() !!}


  @endsection