
@extends('app')

@section('header_content')
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('/css/dropzone/basic.css') }}"/>
  <link rel="stylesheet" href="{{ asset('/css/dropzone/dropzone.css') }}"/>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css"/>
@endsection

@section('content')
    <h1>{{$course_id}}</h1>

@endsection

@section('footer')
    <script type="text/javascript" href="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/dropzone/dropzone.js') }}"></script>


@endsection