@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">ผู้ดูแลระบบ</div>

                    <div class="panel-body">
                        <h4 align="center">ข้อมูลผู้ดูแลระบบ</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ชื่อผู้ใช้</th><th>ชื่อ นามสกุล</th>
                                </tr>
                                <tr>
                                    <td>{{ $admin->id }}</td><td>{{ $admin->adminName }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection