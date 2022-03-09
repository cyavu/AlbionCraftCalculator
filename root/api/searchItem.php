<?php

if ( !isset( $_GET[ "inputItem" ] ) ) {
    echo "Please search for an item at the top";
}

$itemUniqueName = $_GET[ "inputItem" ];
    $itemNiceName = $_GET[ "inputItem" ];
    include_once( "api/dbconnect.php" );
    $sql = "SELECT uniquename, nicename FROM craft WHERE uniquename ='$itemUniqueName' OR nicename LIKE '%$itemNiceName%' LIMIT 1";
    $result = mysqli_query( $conn, $sql );
    if ( mysqli_num_rows( $result ) > 0 ) {
        $row = mysqli_fetch_assoc( $result );
        $itemNiceName = $row[ "nicename" ];
    } else {
        echo "Item not found";
        die();
    }

$itemUniqueName = $row[ "uniquename" ];
$imageurl = 'https://render.albiononline.com/v1/item/';
$imageurlitemUniqueName = 'https://render.albiononline.com/v1/item/' . $itemUniqueName;
$location = "Lymhurst";
$quality = "NORMAL";

$citiesJSON = file_get_contents("/api/JSON/cities.json");
$citiesArray = json_decode( $citiesJSON, true );

if ( isset( $_GET[ "location" ] ) ) {
    $location = $_GET[ "location" ];
}

$cities = array_column($citiesArray, 'name');
if (!in_array($location, $cities)) {
    echo "<h3>Invalid city</h3>";
        die();
}

?>