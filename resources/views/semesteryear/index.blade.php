@extends('app')

@section('content')
 <script type="text/javascript">

 $(document).ready(function() {
     $('#example').dataTable( {
         "order": [[ 3, "desc" ]]
     } );
 } );

     </script>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">ภาคเรียน ปีการศึกษา</div>
                    
                    <div class="panel-body">
                        {{--<h1>semesteryears</h1>--}}
                        <h4><a href="{{ url('/semesteryear/create') }}" class="btn btn-default">เพิ่มภาคการศึกษา</a></h4>
                        <div class="table-responsive">
                            <table class="table" id="example" cellspacing="0" width="100%" >
                                <thead>
                                <tr>
                                    <th>ลำดับ</th><th>ภาคการศึกษา</th><th>ปีการศึกษา</th><th>สถานะ</th><th>แก้ไข</th><th>ลบ</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ลำดับ</th><th>ภาคการศึกษา</th><th>ปีการศึกษา</th><th>สถานะ</th><th>แก้ไข</th><th>ลบ</th>
                                </tr>
                                </tfoot>
                                <tbody>
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

                                        <td><a href="{{ url('/semesteryear/'.$item->id.'/edit') }}" class="btn btn-default">Edit</a>
                                        </td>
                                        <td> {!! Form::open(['method'=>'delete','action'=>['SemesteryearController@destroy',$item->id]]) !!}<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>{!! Form::close() !!}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection