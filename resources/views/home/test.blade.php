@extends('app')
@section('content')






    <script type="text/javascript">

$(document).ready(function() {
    $('#example').dataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );

    </script>
        <table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>

        </tr>
    </thead>

    <tfoot>

        <tr>
            <th>Id</th>
            <th>firstname</th>
            <th>Office</th>
            <th>Age</th>

        </tr>
    </tfoot>

    <tbody>
    @foreach($student as $key)
        <tr>
            <td>{{$key->id}}</td>
            <td>{{$key->firstname_th}}</td>
            <td>{{$key->lastname_th}}</td>
            <td>{{$key->email}}</td>
        </tr>
        @endforeach
</tbody>
</table>

@endsection