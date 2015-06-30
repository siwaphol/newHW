@extends('app')
@section('content')
<?php
$sql=DB::select('select * from courses');
$count=count($sql);
$i=0;
$key=$sql;
?>
<script type="text/javascript">
	$(document).ready(function() {

        //the min chars for username
        var min_chars = 3;

        //result texts
        var characters_error = 'Minimum amount of chars is 3';
        var checking_html = 'Checking...';

        //when button is clicked
        $('#check_username_availability').click(function(){
            //run the character number check
            if($('#course').val().length < min_chars){
                //if it's bellow the minimum show characters_error text '
                $('#username_availability_result').html(characters_error);
            }else{
                //else show the cheking_text and run the function to check
                $('#username_availability_result').html(checking_html);
                check_availability();
            }
        });

  });

//function to check username availability
function check_availability(){

        //get the username
        var course = $('#courseid').val();
        var sec = $('#sectionid').val();

        //use ajax to run the check
        $.post("check()", { course: course,sec: sec },
            function(result){
                //if the result is 1
                if(result == 1){
                    //show that the username is available
                    $('#username_availability_result').html(course +sec+ ' is Available');
                }else{
                    //show that the username is NOT available
                    $('#username_availability_result').html(course+ sec+ ' is not Available');
                }
        });

}
</script>

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
  <option value={{$key[$i]->id}}>{{$key[$i]->id."   ".$key[$i]->name}}</option>
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
$sql=DB::select('select * from users where role_id=0100 order by username');
$count=count($sql);
$key=$sql;
for($i=0;$i<$count;$i++){?>
  <option value={{$key[$i]->username}}>{{$key[$i]->firstname_th." ".$key[$i]->lastname_th}}</option>
  <?php }?>

</select>
</div>
<div class="form-group">
{!! Form::submit('เพิ่มตอน',['class'=>'btn btn-primary form-control'],['id'=>'check_username_availability'],['value'=>'Check Availability'])!!}
</div>
<div id='username_availability_result'></div>
{!! Form::close() !!}

</div>
</div>
</div>
</div>
</div>
<?
function check(){
$course = mysql_real_escape_string($_POST['course']);
$sec = mysql_real_escape_string($_POST['sec']);

$result=DB::select('select * from course_section where course_id=? and section=? ',array($course,$sec));
$count=count($result);
if($count>0){
   echo 0;

}else{
    echo 1;
}
}

?>
  @endsection


