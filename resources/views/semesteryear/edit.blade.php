@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">ปรับปรุง ภาคเรียน ปีการศึกษา</div>

                    <div class="panel-body">

                        {!! Form::model($semesteryear, ['method' => 'PATCH', 'action' => ['SemesteryearController@update', $semesteryear->id]]) !!}

                       <div class="form-group">
                        {!! Form::label('semester', 'ภารเรียน: ') !!}
                        {!! Form::text('semester', $semesteryear->semetser, ['class' => 'form-control','disabled' => 'disabled']) !!}
                    </div><div class="form-group">
                        {!! Form::label('year', 'ปีการศึกษา: ') !!}
                        {!! Form::text('year', $semesteryear->year, ['class' => 'form-control','disabled' => 'disabled']) !!}
                    </div>
                    @if($semesteryear->use=="1")
                        <div class="form-group">
                            {!! Form::label('use', 'สถานะ: ') !!}
                            <select class="form-control" name="use">
                          <option value="1" selected>เปิด</option>
                          <option value="0">ปิด</option>
                        </select>

                        </div>
                    @endif
                    @if($semesteryear->use=="0")
                    <div class="form-group">
                        {!! Form::label('use', 'สถานะ: ') !!}
                        <select class="form-control" name="use">
                          <option value="1" >เปิด</option>
                          <option value="0" selected>ปิด</option>
                        </select>
                    </div>
                    @endif
                        
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