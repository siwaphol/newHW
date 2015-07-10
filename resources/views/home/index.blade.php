
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
                    <div class="panel-heading" align="center">กระบวนวิชา ตอน</div>

                    <div class="panel-body">
 @if(Auth::user()->isAdmin())
{!! Html::link('course_section/create', 'เพิ่มตอนทีละตอน') !!} </br>
{!! Html::link('course_section/selectcreate', 'เพิ่มตอนทั้งกระบวนวิชา') !!}
@endif

<div class="table-responsive">
    <table class="table" id="example" cellspacing="0" width="100%" >

        <thead>
            <tr>

                {{--<th>ที่</th>--}}
                <th>รหัสวิชา</th>
                <th>ชื่อกระบวนวิชา</th>
                <th>ตอน</th>
                {{--<th>อาจารย์</th>--}}
                {{--<th>ดูข้อมูล</th>--}}



            </tr>
        </thead>
         <tfoot>
            <tr>

                {{--<th>ที่</th>--}}
                <th>รหัสวิชา</th>
                <th>ชื่อกระบวนวิชา</th>
                <th>ตอน</th>
                {{--<th>อาจารย์</th>--}}
                {{--<th>ดูข้อมูล</th>--}}



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

  @endsection

  @section('footer')
  <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">

  $(document).ready(function() {
      $('#example').dataTable( {
          "order": [[ 1, "desc" ]],
          "scrollX": true
      } );

  } );

      </script>

  @endsection