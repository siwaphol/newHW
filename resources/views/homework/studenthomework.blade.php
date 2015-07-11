@extends('app')

@section('header_content')
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('/css/dropzone/basic.css') }}"/>
  <link rel="stylesheet" href="{{ asset('/css/dropzone/dropzone.css') }}"/>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css"/>
@endsection

@section('content')
    <div class="container well">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Testing</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/dropzone/dropzone.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#users-table').DataTable( {
            processing: true,
            serverSide: true,
            ajax: '{{ url("coursedata/204111") }}'
        } );
    } );
    </script>
@endsection
