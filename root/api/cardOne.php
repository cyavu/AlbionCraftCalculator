<?php

$itemUniqueName = $_GET[ "inputItem" ];
$itemNiceName = $_GET[ "inputItem" ];
include_once( "api/dbconnect.php" );
$sql = "SELECT uniquename, nicename FROM craft WHERE uniquename ='$itemUniqueName' OR nicename LIKE '%$itemNiceName%' LIMIT 1";
$result = mysqli_query( $conn, $sql );
if ( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $itemUniqueName = $row[ "uniquename" ];
    $itemNiceName = $row[ "nicename" ];
} else {
    echo "Item not found";
    die();
}

// Site-wide functions// Global variables
$APIbaseURL = 'https://www.albion-online-data.com/api/v2/stats/Prices/';
$imageurl = 'https://render.albiononline.com/v1/item/';
$imageurlitemUniqueName = 'https://render.albiononline.com/v1/item/' . $itemUniqueName;


foreach ( $citiesArray as $citiesData ) {
echo "<a href=\"/index.php?inputItem=" . $itemUniqueName . "&location=" . $citiesData['name'] . "\" class=\"btn ";
if ($location == $citiesData['name']) {
    echo "btn-lg "; } else {
    echo "btn-sm "; }
echo "btn-" . $citiesData['buttonClass']  . "\">" . $citiesData['name'] . "</a> ";
}

if (!in_array($location, $cities)) {
    echo "<br><br><div class=\"alert alert-danger\" role=\"alert\">
  You have entered an invalid city.</div>";
        die();
}

?>