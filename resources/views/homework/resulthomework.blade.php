
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
                $sql=DB::select('select * from homework_student where homework_name LIKE ? and student_id=?
                                  and course_id=? and section=?',array('%'.$key->name.'%',$item->student_id,'204111','001'));
                $hw=count($sql);

                if($hw>0){
                   if($sql[0]->status==1){
                   echo "<td>ok</td>";
                   }elseif($sql[0]->status==2){
                      echo "<td>late</td>";
                      }elseif($sql[0]->status==3){
                      echo "<td>!!!</td>";
                      }else{

                         echo "<td>No</td>";
                        }

                        }else{
                        echo "<td>No</td>";
                        }
                ?>

                @endforeach


            </tr>

          @endforeach
	   </tbody>
    </table>


@endsection