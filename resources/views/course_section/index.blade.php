
@extends('app');
@section('content')
<?php

//echo var_dump($model);
$i=1;
?>
<h1 align="center">จัดการตอน</h1>
<?php

?>
{!! Html::link('course_section/create', 'เพิ่มตอน') !!}
<div class="table-responsive">
    <table class="table table-bordered">
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
                 <td>{{$key->teachername}}</td>
                <td>{!! Html::link('course_section/edit/'.$key->courseid.$key->sectionid, 'แก้ไข') !!}</td>
                <td>{!! Html::link('delete/'.$key->courseid, 'ลบ') !!}</td>


            </tr>
            <?php $i++;?>
          @endforeach
        </tbody>
    </table>
</div>
<?php
  $sql=DB::select('select * from courses');
  echo $sql[0]->id;
  dis(15);


  function dis($id){
  echo"id id =".$id;
  }
?>
  @endsection