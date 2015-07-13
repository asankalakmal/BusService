<?php

namespace App\Http\Controllers\businfo;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\BusServiceLib;
use App\BusStop;
use DB;
use Auth;

class BusService extends Controller
{

    /**
     * Display Bus arrival times of the given bus stop
     * Check user is logged or not, if not return login page
     * Otherwise get the bus arrival time and bus stop info
     *
     * @return a view
     */
    public function getBusArrivalTimes($stopID)
    {
        if ( !Auth::guest() ) {
            $busLib = new BusServiceLib();
            $busRoutes = $busLib->getBusArrivalTimes($stopID);
            $bushalt = BusStop::where('bus_stop_id', $stopID)->first();
            return view("businfo/busStopInfo", ['busRoutes' => $busRoutes, 'busHaltInfo' => $bushalt]);
        } else {
            return redirect("auth/login");
        }
        
    }

}
