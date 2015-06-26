
@extends('app');
@section('content')
<?php
$key=$course;
?>
<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">แก้ไขกระบวนวิชา</div>

                    <div class="panel-body">

{{ Form::open(['url'=>'course/saveedit']) }}
<div class="form-group">
{{ Form::label('id','รหัส')}}
{{ Form::text('id',$course->id,['class'=>'form-control'])}}
</div>
<div class="form-group">
{{ Form::label('courseName','ชื่อกระบวนวิชา')}}
{{ Form::text('courseName',$course->courseName,['class'=>'form-control'])}}
</div>
<div class="form-group">
{{ Form::submit('addcourse',['class'=>'btn btn-primary form-control'])}}
</div>
</div>
</div>
</div>
</div>
</div>

{{ Form::close() }}


  @endsection