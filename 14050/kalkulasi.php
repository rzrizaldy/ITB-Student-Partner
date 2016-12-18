<?php

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::                                                                         :*/
/*::  This routine calculates the distance between two points (given the     :*/
/*::  latitude/longitude of those points). It is being used to calculate     :*/
/*::  the distance between two locations using GeoDataSource(TM) Products    :*/
/*::                                                                         :*/
/*::  Definitions:                                                           :*/
/*::    South latitudes are negative, east longitudes are positive           :*/
/*::                                                                         :*/
/*::  Passed to function:                                                    :*/
/*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
/*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
/*::    unit = the unit you desire for results                               :*/
/*::           where: 'M' is statute miles (default)                         :*/
/*::                  'K' is kilometers                                      :*/
/*::                  'N' is nautical miles                                  :*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

$info = array();
if(isset($_GET["lat1"]) && isset($_GET["lng1"]) && isset($_GET["lat2"]) && isset($_GET["lng2"])){
	$lat1 = $_GET["lat1"];
	$lng1 = $_GET["lng1"];
	$lat2 = $_GET["lat2"];
	$lng2 = $_GET["lng2"];
	$jarak =  distance($lat1, $lng1, $lat2, $lng2);
	
	$init = $jarak/1.3889; //Jalan Kaki
	$init2 = $jarak/5; //Kendaraan
	
	$hours = floor($init / 3600); //Waktu tempuh dengan jalan kaki
	$minutes = floor(($init / 60) % 60);
	$seconds = $init % 60;
	
	$hours2 = floor($init2 / 3600); //Waktu tempuh dengan kendaraan
	$minutes2 = floor(($init2 / 60) % 60);
	$seconds2 = $init2 % 60;
	
	array_push($info, $lat1, $lng1, $lat2, $lng2, $jarak, $hours, $minutes, $seconds, $hours2, $minutes2, $seconds2);
}

function distance($lat1, $lon1, $lat2, $lon2) {
  $unit = 'K';
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344 *1000); //Meters
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}

exit(json_encode($info));
?>
