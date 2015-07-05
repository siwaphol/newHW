@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h1>Create a new semesteryear</h1>
                        <hr/>

                        {!! Form::open(['url' => 'semesteryear/create/save']) !!}
                        
                      <div class="form-group">
                        {!! Form::label('semester', 'Semester: ') !!}
                        {!! Form::text('semester', null, ['class' => 'form-control']) !!}
                    </div><div class="form-group">
                        {!! Form::label('year', 'Year: ') !!}
                        {!! Form::text('year', null, ['class' => 'form-control']) !!}
                    </div>

                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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