<?php

$itemToStr = $itemUniqueName;
$itemToCount = strlen($itemToStr);
$itemToSearchwCount = $itemToCount + 2;
if (strpos($itemToStr, '@') ) {
    $itemToStr1 = substr( $itemToStr, 3, -2 );
}
    else {
    $itemToStr1 = substr( $itemToStr, 3 );
    }
//echo $itemToStr1;
//if ( $itemToCount > 5 ) {
//$itemToStr1 = substr( $itemToStr, 3 );
//};
//echo $itemToStr1;
if ( isset($itemToStr1)) {
$sql = "SELECT uniquename, nicename FROM craft WHERE uniquename LIKE '%$itemToStr1' AND uniquename NOT LIKE '%_ARTEFACT_%' OR uniquename LIKE '%$itemToStr1@%' AND uniquename NOT LIKE '%_ARTEFACT_%' AND LENGTH(uniquename) <= $itemToSearchwCount LIMIT 50";
$resultTier = mysqli_query( $conn, $sql );
if ( mysqli_num_rows( $resultTier ) > 0 ) {
  // output data of each row
  while ( $itemTiers = mysqli_fetch_assoc( $resultTier ) ) {
    echo "<a href=\"?inputItem=" . $itemTiers[ "uniquename" ] . "&location=" . $location . "\"\"><img data-toggle=\"tooltip\" data-placement=\"top\" title=\"" . $itemTiers[ "nicename" ] . "\" src=" . $imageurl . $itemTiers[ "uniquename" ] . "?size=64></a>";
  }
}
}

?>