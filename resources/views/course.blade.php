@extends('app')
@section('content')
<?php

$i=1;
?>
<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                                    <div class="panel-heading" align="center">จัดการกระบวนวิชา</div>
                                    <div class="panel-body">

<?php
/*echo Form::open(array('action' => 'CourseController@create'));
echo Form::submit('เพิ่มกระบวนวิชา');
echo Form::close();

echo Form::open(array('create' => 'CourseController@create'));
echo Form::submit('เพิ่มกระบวนวิชา');
echo Form::close();
*/
?>
{!! Html::link('course/create', 'เพิ่มกระบวนวิชา') !!}
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>

                <th>ที่</th>
                <th>รหัสวิชา</th>
                <th>ชื่อกระบวนวิชา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>


            </tr>
        </thead>
        @foreach($model as $key)
        <tbody>
            <tr>
                <td>{{$i}}</td>
                <td>{{$key->id}}</td>
                <td>{{$key->name}}</td>
                <td>{!! Html::link('edit/'.$key->id, 'แก้ไข') !!}</td>
                <td>{!! Html::link('delete/'.$key->id, 'ลบ') !!}</td>


            </tr>
            <?php $i++;?>
          @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>

  @endsection