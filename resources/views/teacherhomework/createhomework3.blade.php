@extends('app')
@section('header_content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-datetimepicker/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/material-design-iconic-font.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/file-and-folder.css') }}" />
@endsection

@section('content')
    <div class="container well">
        <h3 align="center">Create Homework {{$course_id}}</h3>
        <div class="row" style="margin-bottom: 15px;padding-right: 19px;">
            <div class="pull-right">
                <button type="button" class="btn btn-default" id="file_add_btn">
                    <span class="extraicon-file-add"></span>
                </button>
            </div>
        </div>

        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Type</th>
                    <th colspan="{{count($section_list)}}">Due Date</th>
                    <th colspan="{{count($section_list)}}">Accept Until</th>
                </tr>
                <tr>
                    @foreach($section_list as $aSection)
                        <th>{{$aSection->section}}</th>
                    @endforeach
                    @foreach($section_list as $aSection)
                        <th>{{$aSection->section}}</th>
                    @endforeach
                </tr>
            </thead>

        </table>

    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/moment-with-locales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap/transition.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap/collapse.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery-bootstrap-modal-steps.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('/js/validator.min.js') }}"></script>--}}

    <!-- Add File Modal -->
    @include('partials.file_add_wizard_dialog')
    <!-- Add Folder Modal -->
    @include('partials.folder_add_dialog')

    {{--datetimepicker--}}
    <script type="text/javascript">
        $(function () {
            var opt = "";
            $("#addFileOK").click(function(){
                var temp = $('form.addFileForm').serialize();
    //            var n = window.location.pathname.indexOf('homework/create/');
    var paths = window.location.pathname.split('/');
    $.ajax({
      url: paths[paths.length-1],
      type: "POST",
      data: {new_file: temp, _token: $('input[name=_token]').val(),method: opt},
      success: function(data){
        location.reload();
    }
    });
    });
            $("#addFolderOK").click(function(){
                var temp = $('form.addFolderForm').serialize();
                var paths = window.location.pathname.split('/');
                $.ajax({
                  url: paths[paths.length-1],
                  type: "POST",
                  data: {new_folder: temp, _token: $('input[name=_token]').val(),method: opt},
                  success: function(data){
                    location.reload();
                }
            });
            });
            $("#file_add_btn").on('click',  function(){
                opt = 'add';
                $('#addFileModal').modal('toggle');
            });
            $("#folder_add_btn").on('click', function(){
                opt = 'add';
                $('#addFolderModal').modal('toggle');
            });
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('#users-table').DataTable( {
            "scrollX": true,
            processing: true,
            serverSide: true,
            ajax: '{{ url("coursehomeworkdata") }}{{'/'.$course_id}}',
            columns: [
                        {data: 'name', name: 'name'},
                        {data: 'type_id', name: 'type_id'},
                        @foreach($section_list as $aSection)
                            {data: 'due_date'+'{{$aSection->section}}',name: 'due_date'+'{{$aSection->section}}' },
                        @endforeach
                        @foreach($section_list as $aSection)
                            {data: 'accept_until'+'{{$aSection->section}}',name: 'accept_until'+'{{$aSection->section}}' },
                        @endforeach
                    ]
        } );

    } );
    </script>
@endsection