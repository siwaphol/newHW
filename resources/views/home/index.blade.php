
@extends('app')
@section('header_content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection
@section('content')

<?php

//echo var_dump($model);
$i=1;
?>
<?php

?>

<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">Course Section</div>

                    <div class="panel-body">
 @if(Auth::user()->isAdmin())
 {!! Html::link('course_section/auto', 'Import course section from registration office',array('onclick'=>"return confirm('Are you sure you want to add all course section from registration?')")) !!} </br>
 {{--<a href="{{url('students/autoimport')}}">นำเข้านักศึกษาทั้งหมด</a>--}}
 {!! Html::link('students/autoimport', 'Import student information from registration office',array('onclick'=>"return confirm('Are you sure you want to update all students?')")) !!}</br>
{!! Html::link('course_section/create', 'Add a section') !!} </br>
{!! Html::link('course_section/selectcreate', 'Add mutiple section') !!}

@endif

<div class="table-responsive">
    <table class="table" id="example" cellspacing="0" width="100%" >

        <thead>
            <tr>

                {{--<th>No</th>--}}
                <th>Course No</th>
                <th>Title</th>
                <th>Section</th>
                {{--<th>อาจารย์</th>--}}
                {{--<th>ดูข้อมูล</th>--}}
                @if(Auth::user()->isAdmin())
                <th>Edit</th>
                <th>Delete</th>
                @endif


            </tr>
        </thead>
         <tfoot>
            <tr>

                {{--<th>No</th>--}}
                <th>Course No</th>
                <th>Title</th>
                <th>Section</th>
                {{--<th>อาจารย์</th>--}}
                {{--<th>ดูข้อมูล</th>--}}
                @if(Auth::user()->isAdmin())
                <th>Edit</th>
                 <th>Delete</th>
                @endif


            </tr>
        </tfoot>


        <tbody>
         @foreach($result as $key)
            <tr>
                {{--<td>{{$i}}</td>--}}
                <td>{{$key->courseid}}</td>
                <td>{!! link_to_action('HomeController@preview',$key->coursename,array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>
                <td>{!! link_to_action('HomeController@preview',$key->sectionid,array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>
                 {{--<td>{{$key->firstname}}  {{$key->lastname}}</td>--}}
                {{--<td><button type="button" class="btn btn-default">{!! link_to_action('HomeController@preview','ดูข้อมูล',array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</button></td>--}}
               @if(Auth::user()->isAdmin())
                <td>{!! link_to_action('Course_SectionController@edit','Edit',array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>
                 <td><a onclick="return confirm('Are you sure you want to delete student from this section?')">{!! link_to_action('Course_SectionController@delete','Delete',array('id'=>$key->id,'course'=>$key->courseid,'sec'=>$key->sectionid),array('onclick'=>"return confirm('Are you sure you want to delete student from this section?')"))!!}</a></td>

                @endif
            </tr>
            <?php $i++;?>
          @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>


@if(Auth::user()->isStudentandTa())
<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">Course Section Study</div>

                    <div class="panel-body">
 @if(Auth::user()->isAdmin())
 {{--{!! Html::link('course_section/auto', 'เพิ่มกระบวนวิชา ตอน จากสำนักทะเบียน') !!} </br>--}}
{{--{!! Html::link('course_section/create', 'เพิ่มตอนทีละตอน') !!} </br>--}}
{{--{!! Html::link('course_section/selectcreate', 'เพิ่มตอนทั้งกระบวนวิชา') !!}--}}
@endif

<div class="table-responsive">
    <table class="table" id="example1" cellspacing="0" width="100%" >

        <thead>
            <tr>

                {{--<th>No</th>--}}
                <th>Course No</th>
                <th>Title</th>
                <th>Section</th>
                {{--<th>อาจารย์</th>--}}
                {{--<th>ดูข้อมูล</th>--}}
                @if(Auth::user()->isAdmin())
                <th>Edit</th>
                <th>Delete</th>
                @endif


            </tr>
        </thead>
         <tfoot>
            <tr>

                {{--<th>No</th>--}}
                <th>Course No</th>
                <th>Title</th>
                <th>Section</th>
                {{--<th>อาจารย์</th>--}}
                {{--<th>ดูข้อมูล</th>--}}
                @if(Auth::user()->isAdmin())
                <th>Edit</th>
                 <th>Delete</th>
                @endif


            </tr>
        </tfoot>


        <tbody>
         @foreach($assist as $key)
            <tr>
                {{--<td>{{$i}}</td>--}}
                <td>{{$key->courseid}}</td>
                <td>{!! link_to_action('HomeController@preview1',$key->coursename,array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>
                <td>{!! link_to_action('HomeController@preview1',$key->sectionid,array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>
                 {{--<td>{{$key->firstname}}  {{$key->lastname}}</td>--}}
                {{--<td><button type="button" class="btn btn-default">{!! link_to_action('HomeController@preview','ดูข้อมูล',array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</button></td>--}}
               @if(Auth::user()->isAdmin())
                <td>{!! link_to_action('Course_SectionController@edit','Edit',array('course'=>$key->courseid,'sec'=>$key->sectionid))!!}</td>
                 <td><a onclick="return confirm('Are you sure you want to delete student from this section?')">{!! link_to_action('Course_SectionController@delete','Delete',array('id'=>$key->id,'course'=>$key->courseid,'sec'=>$key->sectionid),array('onclick'=>"return confirm('Are you sure you want to delete student from this section?')"))!!}</a></td>

                @endif
            </tr>
            <?php $i++;?>
          @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
@endif
  @endsection

  @section('footer')
  <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">

  $(document).ready(function() {
      $('#example').dataTable( {
          "order": [[ 0, "asc" ]],
          "scrollX": true,
          "columnDefs": [
                      {"sClass": "a-right",},
                      { "width": "4%", "targets": 0 },
                      { "width": "45%", "targets": 1 }
//                      { "width": "2%", "targets": 2 }
          //            { "bSortable": false, "aTargets": [ 0 ] }
                    ]


      } );

  } );
   $(document).ready(function() {
        $('#example1').dataTable( {
            "order": [[ 0, "asc" ]],
            "scrollX": true
        } );

    } );

      </script>

  @endsection
