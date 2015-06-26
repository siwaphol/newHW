@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">ข้อมูลนักศึกษา</div>

                    <div class="panel-body">
                        <h1>student</h1>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>รหัสนักศึกษา</th><th>ชื่อ นามสกุล</th><th>สถานะ</th>
                                </tr>
                                <tr>
                                    <td>{{ $student->id }}</td><td>{{ $student->studentName }}</td><td>{{ $student->status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection