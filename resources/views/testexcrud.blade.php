<?php
    require_once '../xcrud/xcrud/xcrud.php';
    $xcrud = Xcrud::get_instance();
    $xcrud->table('courses');
    ?>
@extends('app')
@section('content')


<?php
echo $xcrud->render();
?>
@endsection

