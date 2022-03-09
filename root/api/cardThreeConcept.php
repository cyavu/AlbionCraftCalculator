<?php

$sql = "SELECT * FROM craft WHERE uniquename='$itemUniqueName'";
$result = mysqli_query( $conn, $sql );
if ( mysqli_num_rows( $result ) > 0 ) {
    while ( $row = mysqli_fetch_assoc( $result ) ): ?>
<div class="collapse show" id="collapseCardThree">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <tbody>
<?php
    
$craftTables = array (
    'craftitem1','craftitem1_amount',
    'craftitem2','craftitem2_amount',
    'craftitem3','craftitem3_amount',
    'craftitem4','craftitem4_amount',
    'craftitem5','craftitem5_amount',
    'craftitem6','craftitem6_amount'
);

$craftReqItems = array (
    ($craftitem1 = $row[ $craftTables[0] ]),
    ($craftitem2 = $row[ $craftTables[2] ]),
    ($craftitem3 = $row[ $craftTables[4] ]),
    ($craftitem4 = $row[ $craftTables[6] ]),
    ($craftitem5 = $row[ $craftTables[8] ]),
    ($craftitem6 = $row[ $craftTables[10] ])
);


$craftReqItemsCount = array (
    ($craftitem1_amount = $row[ $craftTables[1] ]),
    ($craftitem2_amount = $row[ $craftTables[3] ]),
    ($craftitem3_amount = $row[ $craftTables[5] ]),
    ($craftitem4_amount = $row[ $craftTables[7] ]),
    ($craftitem5_amount = $row[ $craftTables[9] ]),
    ($craftitem6_amount = $row[ $craftTables[11] ])
);
$i = $p = $c = $t = 0;
    
// Hiermee bepalen we hoeveel craftitems we hebben
foreach ($craftReqItems as $countCraft) {
    if (isset($countCraft)) {
        $craftToCombine .= $craftReqItems[$i] . ",";
        $i++;
        $craftItemsMerge .= "craftitem" . $i;
    }
}
    // Set parameters
$craftCombined = substr($craftToCombine, 0, -1); // Remove last comma
$urlcraft = $APIbaseURL . $craftCombined . '?locations=' . $location . '';
$getData = callAPI( 'GET', $urlcraft, false );
$DataResponse = json_decode( $getData, true );
    // Loop door iedere craftitem heen
foreach ($craftReqItems as $craftSQL ) {
    if (isset($craftSQL)) {
        $c++;
        $NestedSQL = "SELECT uniquename, nicename, itemvalue FROM materials WHERE uniquename ='$craftSQL'"; // Query
        $NestedSQLResult = mysqli_query( $conn, $NestedSQL );
        $CraftRow = mysqli_fetch_assoc( $NestedSQLResult ); // Store query
        $CraftNiceName = $CraftRow["nicename"];
        $CraftItemValue = $CraftRow["itemvalue"];
        $ArrayID = array_search($craftSQL, array_column($DataResponse, 'item_id'));
        $CraftPrice = $DataResponse[$ArrayID][ "sell_price_min" ];
        $CraftPriceFormatted = number_format($CraftPrice); // Not using the formatted at the moment since the total amount is calculating comma's
        $CraftDate = $DataResponse[$ArrayID][ "sell_price_min_date" ];
        $CraftLineTotal = $craftReqItemsCount[$p] * $CraftPrice;
        $CraftingTotal = number_format($CraftLineTotal); // Not using the formatted at the moment since the total amount is calculating comma's
        $CraftAllTotal += $CraftLineTotal;
        $CraftItemValue = $CraftItemValue * $craftReqItemsCount[$p];
        $CraftItemValueTotal += $CraftItemValue;
        $Artefact = $row["craftitem".$c."_maxreturnamount"];
        if ($Artefact == 1) {
            $Artefact = 0;
            $ArtefactclassToSet = 'return';
        } elseif ($Artefact == 0) {
            $Artefact = $CraftPrice * $craftReqItemsCount[$p];
            $ArtefactclassToSet = 'noreturn';
        }
        $ArtefactForMatReturn += $Artefact;
        
echo "<tr><td>
<img src=" . $imageurl . $craftSQL . "?size=64>
</td><td>
<button class=\"btn btn-info btn-sm\" id=\"craftItem_amount\">"
. $craftReqItemsCount[$p] .
"</button> 
<a class=\"copy\" data-clipboard-text=\"" . $CraftNiceName . "\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Copy to clipboard\">
" . $CraftNiceName . "</a>
</td><td>
<input id=\"craftitem". $c ."_price\" data-returnmat=\"".$Artefact."\"
oninput=\"PriceUpdate( 'craftitem". $c ."_price', 'craftitem"
. $c . "_totalprice', " . $craftReqItemsCount[$p] . " )\" class=\"".$ArtefactclassToSet."\" type=\"number\" itemamount=\"".$craftReqItemsCount[$p]."\" value='";
echo $CraftPrice . "' tabindex=".$c."></td><td id=\"craftitem". $c ."_totalprice\" class=\"pieceOfTotal\">" . $CraftLineTotal . "<br>
<font size=\"1\">" . dateDiff( $CraftDate ) ."</font>
</td></tr>";

        $p++;
    }
}
    
echo "<tr><td><p class=\"d-none\">999999</p></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td><br><button class=\"btn btn-primary\"><strong class=\"crafting_total\" id=\"crafting_total\">"
. number_format($CraftAllTotal) . "</strong></button>
</td></tr>";
echo "</tbody></table></div></div>";
    endwhile;
    }
else {
    echo "0 results";
}
?>
