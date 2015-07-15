@extends('app')
@section('header_content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection
@section('content')
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
                    <div class="panel-heading" align="center">นักศึกษาช่วยสอน</div>
                    
                    <div class="panel-body">

                        <h4><a href="{{ url('/assistants') }}">นักศึกษาช่วยสอนตามรายวิชา</a></h4>

                        <div class="table-responsive">
                            <table class="table" id="example" cellspacing="0" width="100%" >
                                <thead>
                                <tr>
                                    <th>ลำดับ</th><th>รหัส</th><th>ชื่อ นามสกุล</th><th>edit</th><th>delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ลำดับ</th><th>รหัส</th><th>ชื่อ นามสกุล</th><th>edit</th><th>delete</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                {{-- */$x=0;/* --}}
                                @foreach($tas as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td><a href="{{ url('/ta/show', $item->id) }}">{{ $item->student_id }}</a></td>
                                        <td><a href="{{ url('/ta/show', $item->id) }}">{{ $item->firstname_th." ".$item->lastname_th }}</a></td>
                                        <td><button type="button" class="btn btn-default"><a href="{{ url('/students/edit/'.$item->student_id) }}">Edit</a></button></td>
                                         <td> {!! Form::open(['method'=>'delete','action'=>array('StudentsController@destroy',$item->student_id)]) !!}<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>{!! Form::close() !!}</td>
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
@section('footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.7/js/jquery.dataTables.min.js"></script>

  <script type="text/javascript">

$(document).ready(function() {
    $('#example').dataTable( {
        "order": [[ 3, "desc" ]],
        "scrollX": true
    } );
} );

    </script>

@endsection