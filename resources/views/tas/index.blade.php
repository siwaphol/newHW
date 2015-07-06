@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">นักศึกษาช่วยสอน</div>
                    
                    <div class="panel-body">

                        <h4><a href="{{ url('/assistants') }}">นักศึกษาช่วยสอนตามรายวิชา</a></h4>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ลำดับ</th><th>รหัส</th><th>ชื่อ นามสกุล</th><th>edit</th><th>delete</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                @foreach($tas as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td><a href="{{ url('/students/show', $item->student_id) }}">{{ $item->student_id }}</a></td>
                                        <td><a href="{{ url('/students/show', $item->student_id) }}">{{ $item->firstname_th." ".$item->lastname_th }}</a></td>
                                        <td><a href="{{ url('/students/edit/'.$item->student_id) }}">Edit</a></td>
                                         <td> {!! Form::open(['method'=>'delete','action'=>array('StudentsController@destroy',$item->student_id)]) !!}<button type="submit" class="btn btn-link">Delete</button>{!! Form::close() !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection