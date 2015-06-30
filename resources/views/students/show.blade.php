@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">ข้อมูลนักศึกษา</div>

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>รหัส</th><th>ชื่อ นามสกุล</th><th>คณะ</th><th>อีเมล</th><th>สถานะ</th>
                                </tr>

                                @foreach( $student as $result)
                                <tr>
                                    <td>{{$result->student_id}}</td><td>{{$result->firstname." ".$result->lastname}}</td><td>{{$result->faculty}}</td><td>{{$result->email}}</td><td></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection