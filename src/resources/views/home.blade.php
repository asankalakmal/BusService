
@extends('master')
 
@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>Bus Stop Number</th>
                            <th>Name</th>
                            <th>Select</th>
                        </thead>
                        <tbody>
                            @foreach ($busStops as $busStop)
                                <tr>
                                    <td>{{$busStop->bus_stop_id}}</td>
                                    <td>{{$busStop->bus_stop_name}}</td>
                                    <td><a href="{{url('/bus/stop', [$busStop->bus_stop_id])}}" class="btn btn-primary" role="button">Select</a></td>
                                </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection