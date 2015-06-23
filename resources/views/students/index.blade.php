@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    
                    <div class="panel-body">
                        <h1>students</h1>
                        <h2><a href="{{ url('/students/create') }}">Create</a></h2>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>SL.</th><th>Name</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                @foreach($students as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td><td><a href="{{ url('/students/show', $item->id) }}">{{ $item->studentName }}</a></td><td><a href="{{ url('/students/edit/'.$item->id) }}">Edit</a> / {!! Form::open(['method'=>'delete','action'=>array('StudentsController@destroy',$item->id)]) !!}<button type="submit" class="btn btn-link">Delete</button>{!! Form::close() !!}</td>
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