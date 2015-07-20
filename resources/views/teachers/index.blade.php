@extends('app')
@section('header_content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection
@section('content')
 @section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">LECTURER</div>
                    
                    <div class="panel-body">

                        <h4><a href="{{ url('/teachers/create') }}">Add Lecturer</a></h4>
                        <div class="table-responsive">
                            <table class="table" id="example" cellspacing="0" width="100%" >
                                <thead>
                                <tr>
                                    <th>No</th><th>Name</th><th>Edit</th><th>Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                 <th>No</th><th>Name</th><th>Edit</th><th>Delete</th>
                                </tr>
                                 </tfoot>
                                 <tbody>
                                {{-- */$x=0;/* --}}
                                @foreach($teachers as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td><a href="{{ url('/teachers/show', $item->id) }}">{{ $item->firstname_en." ".$item->lastname_en }}</a></td>
                                        <td><button type="button" class="btn btn-link"><a href="{{ url('/teachers/'.$item->id.'/edit') }}">Edit</a></button></td>
                                        <td> {!! Form::open(['method'=>'post','action'=>array('TeachersController@destroy',$item->id)]) !!}<button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete?')">Delete</button>{!! Form::close() !!}</td>
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