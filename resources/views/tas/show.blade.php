@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h1>ta</h1>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ID.</th><th>Name</th>
                                </tr>
                                <tr>
                                    <td>{{ $ta->id }}</td><td>{{ $ta->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection