@extends('app')

@section('content')


<?php echo Auth::user()->name;

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    
                    <div class="panel-body">
                        <h1>assistants</h1>
                        <h2><a href="{{ url('/assistants/create') }}">Create</a></h2>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>SL.</th><th>Name</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                @foreach($assistants as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td><td><a href="{{ url('/assistants/show', $item->id) }}">{{ $item->courseId }}</a></td><td><a href="{{ url('/assistants/'.$item->id.'/edit') }}">Edit</a> / {!! Form::open(['method'=>'delete','action'=>['AssistantsController@destroy',$item->id]]) !!}<button type="submit" class="btn btn-link">Delete</button>{!! Form::close() !!}</td>
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