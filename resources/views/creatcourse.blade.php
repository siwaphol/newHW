
@extends('app');
@section('content')
<h1 align="center">เพิ่มกระบวนวิชา</h1>
{!! Form::open(['url'=>'course']) !!}
<div class="form-group">
{!! Form::label('id','รหัส')!!}
{!! Form::text('id',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::label('courseName','ชื่อกระบวนวิชา')!!}
{!! Form::text('courseName',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::submit('addcourse',['class'=>'btn btn-primary form-control'])!!}
</div>

{!! Form::close() !!}


  @endsection