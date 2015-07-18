@extends('app')
@section('header_content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection
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
                    <div class="panel-heading" align="center">ผู้ดูแลระบบ</div>
                    
                    <div class="panel-body">
                        <!--
                        <h1>admins</h1>
                      -->
                       <h4><a href="{{ url('/admin/create') }}">เพิ่มผู้ดูแลระบบใหม่</a></h4>
                       <h4><a href="{{ url('/admin/assign') }}">เพิ่มผู้ดูแลระบบจากผู้ใช้</a></h4>
                        <div class="table-responsive">
                            <table class="table" id="example" cellspacing="0" width="100%" >
                                <thead>
                                <tr>
                                    <th>ที่</th><th>ชื่อ นามสกุล</th><th>edit</th><th>delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ที่</th><th>ชื่อ นามสกุล</th><th>edit</th><th>delete</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                {{-- */$x=0;/* --}}
                                @foreach($admins as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td><a href="{{ url('admin/show', $item->id) }}">{{ $item->firstname_th.' '.$item->lastname_th }}</a></td>
                                        <td><button type="button" class="btn btn-link"><a href="{{ url('/admin/'.$item->id.'/edit') }}">Edit</a></button></td>
                                        <td> {!! Form::open(['method'=>'delete','action'=>array('AdminController@destroy',$item->id)]) !!}<button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete?')">Delete</button>{!! Form::close() !!}</td>
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