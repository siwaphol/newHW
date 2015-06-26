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
$sql=DB::select('select * from courses');
$count=count($sql);
$i=0;
$key=$sql;
?>


<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">เพิ่มตอน</div>

                    <div class="panel-body">
{!! Form::open(['url'=>'course_section/create/save']) !!}
<div class="form-group">

{!! Form::label('id','รหัส')!!}
<select name="courseid" class="form-control">
<?php for($i=0;$i<$count;$i++){?>
  <option value={{$key[$i]->id}}>{{$key[$i]->id."   ".$key[$i]->courseName}}</option>
  <?php }?>

</select>

</div>
<div class="form-group">
{!! Form::label('sectionid','ตอน')!!}
<select class="form-control" name="sectionid">
  <option value="001">001</option>
  <option value="002">002</option>
  <option value="003">003</option>
  <option value="004">004</option>
  <option value="005">005</option>
  <option value="006">006</option>
 </select>
</div>
<div class="form-group">
{!! Form::label('teacherid','อาจารย์')!!}
<select name="teacherid" class="form-control">
<?php
$sql=DB::select('select * from teachers order by id');
$count=count($sql);
$key=$sql;
for($i=0;$i<$count;$i++){?>
  <option value={{$key[$i]->id}}>{{$key[$i]->id."   ".$key[$i]->teacherName}}</option>
  <?php }?>

</select>
</div>
<div class="form-group">
{!! Form::submit('เพิ่มตอน',['class'=>'btn btn-primary form-control'])!!}
</div>

{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>

  @endsection


