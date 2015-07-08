
@extends('app')
@section('content')
<?php

//echo var_dump($model);
$i=1;
?>
<?php

?>

<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">กระบวนวิชา ตอน</div>

                    <div class="panel-body">
{!! Html::link('course_section/create', 'เพิ่มตอนทีละตอน') !!} </br>
{!! Html::link('course_section/selectcreate', 'เพิ่มตอนทั้งกระบวนวิชา') !!}
<div class="table-responsive">
    <table class="table table-bordered"  >
        <thead>
        <thead>
            <tr>

                <th>ที่</th>
                <th>รหัสวิชา</th>
                <th>ชื่อกระบวนวิชา</th>
                <th>ตอน</th>
                <th>อาจารย์</th>
                <th>แก้ไข</th>
                <th>ลบ</th>


            </tr>
        </thead>

        @foreach($result as $key)
        <tbody>
            <tr>
                <td>{{$i}}</td>
                <td>{{$key->courseid}}</td>
                <td>{{$key->coursename}}</td>
                <td>{{$key->sectionid}}</td>
                 <td>{{$key->firstname}}  {{$key->lastname}}</td>
                <td>{!! link_to_action('Course_SectionController@edit','แก้ไข',array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>
                 <td>{!! link_to_action('Course_SectionController@delete','ลบ',array('id'=>$key->id,'course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>


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

<table data-url="data1.json" data-height="299" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1">
    <thead>
    <tr>
        <th data-field="state" data-radio="true">Item ID</th>
        <th data-field="id" data-align="right">Item ID</th>
        <th data-field="name" data-align="center">Item Name</th>
        <th data-field="price" data-align="left">Item Price</th>
    </tr>
    </thead>
</table>
  @endsection