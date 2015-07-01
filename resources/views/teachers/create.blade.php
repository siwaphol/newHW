@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">เพิ่มอาจารย์</div>

                    <div class="panel-body">
                        <hr/>

                        {!! Form::open(['url' => 'teachers/create/save']) !!}
                        
                        <div class="form-group">
                        {!! Form::label('username', 'username: ') !!}
                        {!! Form::text('username', null, ['class' => 'form-control']) !!}
                    </div><div class="form-group">
                        {!! Form::label('firstname_th', 'firstname_th: ') !!}
                        {!! Form::text('firstname_th', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('firstname_en', 'firstname_en: ') !!}
                        {!! Form::text('firstname_en', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname_th', 'lastname_th: ') !!}
                        {!! Form::text('lastname_th', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname_en', 'lastname_en: ') !!}
                        {!! Form::text('lastname_en', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'email: ') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>

                        <div class="form-group">
                            {!! Form::submit('เพิ่ม', ['class' => 'btn btn-primary form-control']) !!}
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