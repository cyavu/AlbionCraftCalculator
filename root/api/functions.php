<?php

function getPercentageChange($oldNumber, $newNumber){
    $decreaseValue = $oldNumber - $newNumber;

    return ($decreaseValue / $oldNumber) * 100;
}

// Location
$citiesJSON = file_get_contents("api/JSON/cities.json");
$citiesArray = json_decode( $citiesJSON, true );


$quality = "NORMAL";
$cities = array_column($citiesArray, 'name');



// Date for number_format
require("api/date.php");
$date = date( 'm/d/Y h:i:s', time() );

$Qualities = array (
    'Normal',
    'Good',
    'Outstanding',
    'Excellent',
    'Masterpiece'
)
    


?>