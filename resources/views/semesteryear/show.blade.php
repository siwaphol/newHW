@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h1>semesteryear</h1>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ID.</th><th>semester</th><th>year</th>
                                </tr>
                                <tr>
                                    <td>{{ $semesteryear->id }}</td><td>{{ $semesteryear->semester }}</td><td>{{ $semesteryear->year }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection