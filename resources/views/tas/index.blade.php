@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">นักศึกษาช่วยสอน</div>
                    
                    <div class="panel-body">
                      <!--
                        <h4><a href="{{ url('/ta/create') }}">เพิ่มนักศึกษาช่วยสอน</a></h4>
                        -->
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ลำดับ</th><th>รหัส</th><th>ชื่อ นามสกุล</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                @foreach($tas as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td><td><a href="{{ url('/ta/show', $item->id) }}">{{ $item->id }}</a></td><td><a href="{{ url('/ta/show', $item->id) }}">{{ $item->firstname_th." ".$item->lastname_th }}</a></td><td><a href="{{ url('/ta/'.$item->id.'/edit') }}">Edit</a> / {!! Form::open(['method'=>'delete','action'=>array('TasController@destroy',$item->id)]) !!}<button type="submit" class="btn btn-link">Delete</button>{!! Form::close() !!}</td>
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