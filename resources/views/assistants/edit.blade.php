@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h1>Edit assistant</h1>
                        <hr/>

                        {{ Form::model($assistant, ['method' => 'PATCH', 'action' => ['AssistantsController@update', $assistant->id]]) }}

                        <div class="form-group">
                        {{ Form::label('courseId', 'Courseid: ') }}
                        {{ Form::text('courseId', null, ['class' => 'form-control']) }}
                    </div><div class="form-group">
                        {{ Form::label('sectionId', 'Sectionid: ') }}
                        {{ Form::text('sectionId', null, ['class' => 'form-control']) }}
                    </div><div class="form-group">
                        {{ Form::label('taId', 'Taid: ') }}
                        {{ Form::text('taId', null, ['class' => 'form-control']) }}
                    </div>
                        
                        <div class="form-group">
                            {{ Form::submit('Update', ['class' => 'btn btn-primary form-control']) }}
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