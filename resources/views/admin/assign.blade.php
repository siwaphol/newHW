@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">เพิ่มผู้ดุแลระบบ</div>

                    <div class="panel-body">

                        <hr/>

                        {!! Form::open(['url' => 'admin/assign/save']) !!}
                        
                       <div class="form-group">
                           {!! Form::label('adminid', 'ผู้ใช้: ') !!}

                            <select id="adminid" name="adminid" onChange = "ListSection(this.value)" class="form-control">
                               <option selected value="">เลือกผู้ใช้</option>
                               @foreach($admin as $item)
                              <option value={{$item->id}}>{{$item->firstname_en.' '.$item->lastname_en}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Add Admin', ['class' => 'btn btn-primary form-control']) !!}
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