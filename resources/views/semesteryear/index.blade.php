@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">ภาคเรียน ปีการศึกษา</div>
                    
                    <div class="panel-body">
                        {{--<h1>semesteryears</h1>--}}
                        <h4><a href="{{ url('/semesteryear/create') }}">เพิ่ม</a></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ลำดับ</th><th>ภาคการศึกษา</th><th>ปีการศึกษา</th><th>สถานะ</th><th>Actions</th>
                                </tr>
                                {{-- */$x=0;/* --}}
                                @foreach($semesteryears as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td><a href="{{ url('/semesteryear/show', $item->id) }}">{{ $item->semester }}</a></td>
                                        <td><a href="{{ url('/semesteryear/show', $item->id) }}">{{ $item->year }}</a></td>
                                        @if($item->use=="1")
                                        <td>เปิด</td>
                                        @endif
                                        @if($item->use=="0")
                                        <td>ปิด</td>
                                        @endif
                                        <td><a href="{{ url('/semesteryear/'.$item->id.'/edit') }}">Edit</a> / {!! Form::open(['method'=>'delete','action'=>['SemesteryearController@destroy',$item->id]]) !!}<button type="submit" class="btn btn-link">Delete</button>{!! Form::close() !!}</td>
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