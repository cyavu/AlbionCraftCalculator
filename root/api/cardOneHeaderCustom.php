<?php

if ( isset( $_GET[ "location" ] ) || (in_array($location, $cities))) {
foreach ( $citiesArray as $citiesDataAlt ) {
if ($location == $citiesDataAlt['name']) {
    echo "Selected city: <span class=\"badge badge-" . $citiesDataAlt['buttonClass'] . "\">" . $citiesDataAlt['name'] . "</span>";
}
}
} else {
    echo "Select the city";
}

?>