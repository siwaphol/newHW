
@extends('app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">

<h1 align="center">เพิ่มกระบวนวิชา</h1>
{!! Form::open(['url'=>'course/create/save']) !!}
<div class="form-group">
{!! Form::label('course_id','รหัส')!!}
{!! Form::text('course_id',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::label('course_name','ชื่อกระบวนวิชา')!!}
{!! Form::text('course_name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!! Form::submit('เพิ่ม',['class'=>'btn btn-primary form-control'])!!}

 @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>เกิดข้อผิดพลาด</strong><br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
</div>
</div>
</div>
</div>

{!! Form::close() !!}


  @endsection