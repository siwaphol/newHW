@extends('app')
@section('content')
 <script type="text/javascript">

 $(document).ready(function() {
     $('#example').dataTable( {
         "order": [[ 3, "desc" ]]
     } );
 } );

     </script>
<?php

$i=1;
?>
<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                                    <div class="panel-heading" align="center">จัดการกระบวนวิชา</div>
                                    <div class="panel-body">

<?php
/*echo Form::open(array('action' => 'CourseController@create'));
echo Form::submit('เพิ่มกระบวนวิชา');
echo Form::close();

echo Form::open(array('create' => 'CourseController@create'));
echo Form::submit('เพิ่มกระบวนวิชา');
echo Form::close();
*/
?>
{!! Html::link('course/create', 'เพิ่มกระบวนวิชา') !!}
<div class="table-responsive">
    <table class="table" id="example" cellspacing="0" width="100%" >
        <thead>
            <tr>


                <th>รหัสวิชา</th>
                <th>ชื่อกระบวนวิชา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>


            </tr>
        </thead>
        <tfoot>
            <tr>


                <th>รหัสวิชา</th>
                <th>ชื่อกระบวนวิชา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>


            </tr>
        </tfoot>

        <tbody>
         @foreach($model as $key)
            <tr>

                <td>{{$key->id}}</td>
                <td>{{$key->name}}</td>
                <td><button type="button" class="btn btn-default">{!! Html::link('edit/'.$key->id, 'แก้ไข') !!}</button></td>
                <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">{!! Html::link('delete/'.$key->id, 'ลบ') !!}</button></td>


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