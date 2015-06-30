
@extends('app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
<h1 align="center">เพิ่มกระบวนวิชา</h1>
{!! Form::open(['url'=>'course/create/save']) !!}
<div class="form-group">
{!! Form::label('id','รหัส')!!}
{!! Form::text('id',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::label('name','ชื่อกระบวนวิชา')!!}
{!! Form::text('name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::submit('เพิ่ม',['class'=>'btn btn-primary form-control'])!!}
</div>
</div>
</div>
</div>

{!! Form::close() !!}


  @endsection