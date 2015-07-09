@extends('app')

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
                    <div class="panel-heading" align="center">อาจารย์</div>
                    
                    <div class="panel-body">

                        <h4><a href="{{ url('/teachers/create') }}">เพิ่มอาจารย์</a></h4>
                        <div class="table-responsive">
                            <table class="table" id="example" cellspacing="0" width="100%" >
                                <thead>
                                <tr>
                                    <th>ลำดับ</th><th>ชื่อนามสกุล</th><th>edit</th><th>delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                <th>ลำดับ</th><th>ชื่อนามสกุล</th><th>edit</th><th>delete</th>
                                </tr>
                                 </tfoot>
                                 <tbody>
                                {{-- */$x=0;/* --}}
                                @foreach($teachers as $item)
                                    {{-- */$x++;/* --}}
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td><a href="{{ url('/teachers/show', $item->id) }}">{{ $item->firstname_th." ".$item->lastname_th }}</a></td>
                                        <td><button type="button" class="btn btn-default"><a href="{{ url('/teachers/'.$item->id.'/edit') }}">Edit</a></button></td>
                                        <td> {!! Form::open(['method'=>'post','action'=>array('TeachersController@destroy',$item->id)]) !!}<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>{!! Form::close() !!}</td>
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