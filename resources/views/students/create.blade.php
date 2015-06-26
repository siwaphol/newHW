@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">เพิ่มนักศึกษา</div>

                    <div class="panel-body">

                        <hr/>

                        {{ Form::open(['url' => 'students/create/save']) }}
                        
                        <div class="form-group">
                        {{ Form::label('id', 'Id: ') }}
                        {{ Form::text('id', null, ['class' => 'form-control']) }}
                    </div><div class="form-group">
                        {{ Form::label('studentName', 'Studentname: ') }}
                        {{ Form::text('studentName', null, ['class' => 'form-control']) }}
                    </div><div class="form-group">
                        {{ Form::label('status', 'Status: ') }}
                        {{ Form::text('status', null, ['class' => 'form-control']) }}
                    </div>

                        <div class="form-group">
                            {{ Form::submit('Create', ['class' => 'btn btn-primary form-control']) }}
                        </div>
                        {{ Form::close() }}

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection