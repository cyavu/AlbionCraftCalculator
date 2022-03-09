<?php

$url = 'https://www.albion-online-data.com/api/v2/stats/Prices/' . $itemUniqueName . '?locations=' . $location . '&qualities=1,2,3,4,5';
$get_data = callAPI( 'GET', $url, false );
$response = json_decode( $get_data, true );
$ItemCount = array_count_values(array_column($response, 'item_id'))[$itemUniqueName]; // Count how many prices for the item to craft
$MapItem = array_column($response, 'sell_price_min');
$itemPrice = min(array_filter($MapItem)); // Lowest price of all qualities except 0
$ArrayIDwLowestPrice = array_search($itemPrice, $MapItem); // Get key in array that we are working inside of, based of the lowest price
$mydate = $response[$ArrayIDwLowestPrice]["sell_price_min_date"];
$QualityNumber = $response[$ArrayIDwLowestPrice]["quality"];
$itemPriceFormatted = number_format($itemPrice);
$QualityNumber = $QualityNumber - 1;
if ($ItemCount > 1) {
    $itemPriceNormal = number_format($response[0]['sell_price_min']);
    if ($itemPriceNormal == 0) {
        $itemPriceNormal = "No_Price";
    }
    $itemPriceGood = number_format($response[1]['sell_price_min']);
    if ($itemPriceGood == 0) {
        $itemPriceGood = "No_Price";
    }
    $itemPriceOutstanding = number_format($response[2]['sell_price_min']);
    if ($itemPriceOutstanding == 0) {
        $itemPriceOutstanding = "No_Price";
    }
    $itemPriceExcellent = number_format($response[3]['sell_price_min']);
    if ($itemPriceExcellent == 0) {
        $itemPriceExcellent = "No_Price";
    }
    $itemPriceMasterpiece = number_format($response[4]['sell_price_min']);
    if ($itemPriceMasterpiece == 0) {
        $itemPriceMasterpiece = "No_Price";
    }
}

echo "<div class=\"table-responsive\">";
echo "<table width=\"100%\" cellspacing=\"0\">";
//echo "<table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">";
echo "<tbody>";
if ($itemPriceGood > 1) {
echo "
<td>
<img src=" . $imageurlitemUniqueName . "?size=64>
</td>
<td>" . $itemNiceName . "</td>
<td class=\"\">
<strong data-toggle=\"tooltip\" data-placement=\"left\" data-html=\"true\" title=\"
Normal: <strong>" .$itemPriceNormal. "</strong><br>
Good: <strong>" .$itemPriceGood. "</strong><br>
Outstanding: <strong>" .$itemPriceOutstanding. "</strong><br>
Excellent: <strong>" .$itemPriceExcellent. "</strong><br>
Masterpiece: <strong>" .$itemPriceMasterpiece. "</strong>
\" id=\"itemprice\" data-itemprice=\"".$itemPrice."\" >
" . $itemPriceFormatted . " <i class=\"fas fa-info-circle\"></i>
<br><font size=\"1\">
" . dateDiff( $mydate ) . "
</font>";
} else {
echo "
<td>
<img src=" . $imageurlitemUniqueName . "?size=64>
</td>
<td>" . $itemNiceName . "</td>
<td class=\"\">
<strong id=\"itemprice\" data-itemprice=\"".$itemPrice."\" >
" . $itemPriceFormatted . "
<br><font size=\"1\">
" . dateDiff( $mydate ) . "
</font>";
}
if ($itemPrice == 0) {
    $ApiURLHistory = 'https://www.albion-online-data.com/api/v2/stats/history/';
    $urlAverage = $ApiURLHistory . $itemUniqueName . '?date=2-5-2020&locations=' . $location . '&qualities=2&time-scale=6';
    $getAveragedata = callAPI( 'GET', $urlAverage, false );
    $responseAverage = json_decode( $getAveragedata, true );
    if (!isset( $responseAverage[0] ) ) {
        $urlAverageOtherCities = $ApiURLHistory . $itemUniqueName . '?date=2-5-2020&qualities=2&time-scale=6';
        $getAveragedataOtherCities = callAPI( 'GET', $urlAverageOtherCities, false );
        $responseAverage = json_decode( $getAveragedataOtherCities, true );
        $AveragePrice = $responseAverage[0]['data'][0]['avg_price'];
    }
    $AveragePrice = $responseAverage[0]['data'][0]['avg_price'];
    $AveragePriceFormatted = number_format($responseAverage[0]['data'][0]['avg_price']);
    if (isset ($AveragePrice)) {
        echo "<br>";
        echo "<button class=\"btn btn-success\" onclick=\"document.getElementById('itemprice').innerHTML = '" . $AveragePriceFormatted . "'\">Show average price</button>";
}
}
echo "</strong></td>";
echo "</tbody>
</table>
</div>";
//echo $urlAverage;
//print_r($responseAverage[0]['data'][0]['avg_price']);
//echo $responseAverage;
//mysqli_close( $conn );
?>