<?php

include ("api/call.php");
$response = json_decode($get_data, true);

echo "<pre>";
var_dump($response);

print_r($response[0]);
echo "<br />";
echo "Specific prints";
echo "<br />";
//echo count($jsonOutput[0]);
echo $response[0]["item_id"];

?>