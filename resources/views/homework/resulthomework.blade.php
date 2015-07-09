
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
$cs=DB::select('select * from course_section where id=?',array($id['id']));
$count=count($sent);
$i=1;
$j=0;
?>


<table class="table" id="example" cellspacing="0" width="100%" >
        <thead>
            <tr>
            <th>ที่</th>
           <th>รหัส</th>
            @foreach($homework as $key)
               <th>{{$key->name}}</th>

            @endforeach
            </tr>
        </thead>
        <tfoot>
                    <tr>
                    <th>ที่</th>
                   <th>รหัส</th>
                    @foreach($homework as $key)
                       <th>{{$key->name}}</th>

                    @endforeach
                    </tr>


        </tfoot>

        <tbody>
        @foreach($sent as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->student_id}}</td>
               @foreach($homework as $key)
               <?php
                $sql=DB::select('select * from homework_student where homework_name LIKE %?% and student_id=?
                                  and course_id=? and section=?',array($key->name,$item->student_id),$cs[0]->course_id,$cs[0]->section);
                $hw=count($sql);
                if($hw>0)
                   if($sql[0]->status=='1'){
                   echo "<td>ok</td>";
                   }elseif($sql[0]->status=='2'){
                      echo "<td>late</td>";
                      }elseif($sql[0]->status=='1'){
                      echo "<td>!!!</td>";
                      }else{

                         echo "<td></td>";
                        }
                ?>

                @endforeach


            </tr>

          @endforeach
	   </tbody>
    </table>


@endsection