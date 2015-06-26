@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">อาจารย์</div>
                    
                    <div class="panel-body">

                        <h4><a href="{{ url('/teachers/create') }}">เพิ่มอาจารย์</a></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ลำดับ</th><th>ชื่อนามสกุล</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                @foreach($teachers as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td><td><a href="{{ url('/teachers/show', $item->id) }}">{{ $item->teacherName }}</a></td><td><a href="{{ url('/teachers/'.$item->id.'/edit') }}">Edit</a> / {{ Form::open(['method'=>'post','action'=>array('TeachersController@destroy',$item->id)]) }}<button type="submit" class="btn btn-link">Delete</button>{{ Form::close() }}</td>
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