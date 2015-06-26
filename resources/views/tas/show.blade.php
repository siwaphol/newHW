@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">ข้อมูลนักศึกษาช่วยสอน</div>

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>รหัส</th><th>ชื่อ นามสกุล</th>
                                </tr>
                                <tr>
                                    <td>{{ $ta->id }}</td><td>{{ $ta->taName }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection