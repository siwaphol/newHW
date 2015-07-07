@extends('app')

@section('content')

<?php
$count=count($sent);
$i=1;
?>



<table class="table table-bordered">
        <thead>
            <tr>
            <th>ที่</th>
           <th>รหัส</th>
            @foreach($homework as $key)
               <th>{{$key->name}}</th>
            @endforeach
            </tr>
            {{dd($key)}}
        </thead>

        <tbody>
        @foreach($sent as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->student_id}}</td>
                <td>late</td>

            </tr>

          @endforeach
	   </tbody>
    </table>


@endsection