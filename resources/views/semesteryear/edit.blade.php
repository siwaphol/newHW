@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h1>Edit semesteryear</h1>
                        <hr/>

                        {!! Form::model($semesteryear, ['method' => 'PATCH', 'action' => ['SemesteryearController@update', $semesteryear->id]]) !!}

                       <div class="form-group">
                        {!! Form::label('semester', 'Semester: ') !!}
                        {!! Form::text('semester', null, ['class' => 'form-control']) !!}
                    </div><div class="form-group">
                        {!! Form::label('year', 'Year: ') !!}
                        {!! Form::text('year', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('use', 'status: ') !!}
                        {!! Form::text('use', null, ['class' => 'form-control']) !!}
                    </div>
                        
                        <div class="form-group">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                        {!! Form::close() !!}

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