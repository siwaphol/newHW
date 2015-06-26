@extends('app')

@section('content')
<?php
$assistants=DB::select('select ass.id as id
                        ,ta.id as taid
                        ,ta.taName as taname
                        from assistants ass
                        left join tas ta on ass.taid=ta.id
                      where courseid=? and  sectionid=?',array($course['co'],$course['sec']));
$count=count($assistants);
$item=$assistants;
?>


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">มอบหมายงานนักศึกษาช่วยสอน</div>
                    
                    <div class="panel-body">
                        <h3 align="center" >กระบวนวิชา {{$course['co']}} ตอน {{$course['sec']}}</h3>
                        <h4><a href="{{ url('/assistants/create') }}">เพิ่ม</a></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ลำดับ</th><th>ชื่อ นามสกุล</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                <?php
                                for($x=0;$x<$count;$x++){
                                ?>

                                    <tr>
                                        <td>{{ $x+1 }}</td><td><a href="{{ url('/assistants/show', $item[$x]->id) }}">{{ $item[$x]->taname }}</a></td><td><a href="{{ url('/assistants/'.$item[$x]->id.'/edit') }}">Edit</a> / {{ Form::open(['method'=>'delete','action'=>['AssistantsController@destroy',$item[$x]->id]]) }}<button type="submit" class="btn btn-link">Delete</button>{{ Form::close() }}</td>
                                    </tr>
                                    <?php  } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection