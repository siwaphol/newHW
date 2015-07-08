@extends('app')

@section('content')

<?php
$count=count($sent);
$i=1;
$j=0;
?>



<table class="table table-bordered">
        <thead>
            <tr>
            <th>ที่</th>
           <th>รหัส</th>
            @foreach($homework as $key)
               <th>{{$key->name}}</th>
               <?php
               $name[$j]=$key->name;
               $j++;
               ?>
            @endforeach
            </tr>

        </thead>

        <tbody>
        @foreach($sent as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->student_id}}</td>
               @foreach($homework as $key)
               <?php
                $sql=DB::select('select * from homework_student where homework_name=? and student_id=?',array($key->name,$item->student_id));
                ?>
                <td>late</td>
                @endforeach


            </tr>

          @endforeach
	   </tbody>
    </table>


@endsection