
@extends('master')
 
@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bus Stop Number: {{ isset($busHaltInfo->bus_stop_id) ? $busHaltInfo->bus_stop_id : 'Unknown Bus Stop ID' }} ({{ isset($busHaltInfo->bus_stop_name) ? $busHaltInfo->bus_stop_name : 'NA' }})</div>
                <div class="panel-body">
                    @if (count($busRoutes) > 0)     
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Bus Route Number</th>
                                <th>Bus Route Name</th>
                                <th>Arrival Time 1 (Min)</th>
                                <th>Arrival Time 2 (Min)</th>
                            </thead>
                            <tbody>
                                @foreach ($busRoutes as $busRoute)
                                    <tr>
                                        <td>{{ isset($busRoute[0]->routeNumber) ? $busRoute[0]->routeNumber : 'NA'}}</td>
                                        <td>{{ isset($busRoute[0]->routeName) ? $busRoute[0]->routeName : 'NA'}}</td>
                                        <td>{{ isset($busRoute[0]->arrivalTime) ? $busRoute[0]->arrivalTime : 'NA'  }}</td>
                                        <td>{{ isset($busRoute[1]->arrivalTime) ? $busRoute[1]->arrivalTime : 'NA' }}</td>

                                    </tr>
                                @endforeach
                            <tbody>
                        </table>
                    @else
                        <p> No Data Found </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection