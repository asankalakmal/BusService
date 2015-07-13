<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Libraries\BusServiceLib;

class HomeController extends Controller
{
    /**
     * Display Bus root informations  
     * Check user is logged or not, if not return login page
     * Otherwise get the nearest bus stops to the user
     *
     * @return Response
     */
    public function index()
    {
        if ( !Auth::guest() ) {

            $busLib = new BusServiceLib();
            $busStops = $busLib->getUserNearestLocation();

            return view("home", ['busStops' => $busStops]);
        } else {
            return view("auth/login");
        }
    }

}
