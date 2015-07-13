<?php
namespace App\Libraries;

use DB;

class BusServiceLib
{
    /**
     * User's GPS position set as config value
     * Drow x miles (configurable value) radius circle, then get nearest 5 bus stops.
     *
     * @return (Object Array)
     */
    public function getUserNearestLocation()
    {
        $lat = config('busservice.user_lat');
        $lon = config('busservice.user_lon');
        $radius = config('busservice.location_radius');

        $busStops = DB::select('SELECT *, 
        ( 3959 * acos( cos( radians(:lat) ) * 
        cos( radians( lat ) ) * 
        cos( radians( lon ) - 
        radians(:lon) ) + 
        sin( radians(:lat_i) ) * 
        sin( radians( lat ) ) ) ) 
        AS distance FROM bus_stop HAVING distance < :miles ORDER BY distance ASC LIMIT 0, 5', ['lon' => $lon, 'lat' => $lat, 'lat_i' => $lat, 'miles' => $radius]);

        return $busStops;
    }

    /**
     * We assume every buses are at the last passed stop (we assume 'bus' table's 'bus_stop_id' coloum will update every buses after passed a stop)
     * Get related route form bus stop id, then check buses last passed stop after calculate the distance from buses to user's bus stop
     *
     * @return (Object Array) Bus arrival time of the given bus stop 
     */
    public function getBusArrivalTimes($busStopID)
    {
        
        $result = DB::select('SELECT A.route_id, D.route_number, D.route_name, B.bus_id, B.speed, (A.distance_from_start - C.distance_from_start) AS user_bus_distance FROM 
        `route_bus_stop` AS A JOIN bus AS B ON A.route_id=B.route_id JOIN `route_bus_stop` AS C ON B.bus_stop_id = C.bus_stop_id AND B.route_id = C.route_id JOIN `route` AS D ON A.route_id = D.route_id WHERE
         A.`bus_stop_id`=:busStopID AND A.sequence_no >= C.sequence_no ORDER BY route_id, user_bus_distance', ['busStopID' => $busStopID]);

        $arrivalTimes = [];
        foreach ($result as $busInfo) {
            if (!isset($arrivalTimes[$busInfo->route_number]) || (isset($arrivalTimes[$busInfo->route_number]) && count($arrivalTimes[$busInfo->route_number]) < 2)) {
                $arrivalTime = $this->getTimeFromBusInfo($busInfo->user_bus_distance, $busInfo->speed);
                $arrivalTimes[$busInfo->route_number][] = (Object)['routeNumber' => $busInfo->route_number, 'routeName' => $busInfo->route_name, 'busID' => $busInfo->bus_id, 'arrivalTime' => $arrivalTime];
            }
             
        }

        return $arrivalTimes;
    }

    /**
     * Calculate the Arrival time from given distance and speed
     *
     * @return (int) time in min  
     */
    private function getTimeFromBusInfo($distance, $speed) 
    {
        return round(($distance/$speed)* 60);
    }


    

}
