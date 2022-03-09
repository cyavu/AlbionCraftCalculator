<div class="table-responsive">
    <table class="table table-striped" width="100%" cellspacing="0">
            <thead class="priceConstr_header">
                <tr>
                    <td>Description</td>
                    <td>without focus</td>
                    <td>with focus</td>
                </tr>
            </thead>
        <tbody>
            <tr>
                <td>Usage fee<footer class="blockquote-footer">of crafting station</footer></td>
                <td class="UsageFeeTotal"><?php $usageFeeinTable = round($CraftItemValueTotal / 20 * 50); echo number_format($usageFeeinTable); ?></td>
                <td class="UsageFeeTotal"><?php $usageFeeinTable = round($CraftItemValueTotal / 20 * 50); echo number_format($usageFeeinTable); ?></td>
            </tr>
            <tr>
                <td>Materials costs</td>
                <td class="crafting_total"><?php echo number_format($CraftAllTotal); ?></td>
                <td class="crafting_total"><?php echo number_format($CraftAllTotal); ?></td>
            </tr>
            <tr>
                <td>Materials returned</td>
                <td id="matReturnedwoFocus">
                    <?php
                    $matReturned1 = $CraftAllTotal - $ArtefactForMatReturn;
                    $matReturned = $matReturned1 /100 * 15;
                    $matReturned = str_replace("-", "", $matReturned);
                    echo "-".number_format($matReturned); ?></td>
                <td id="matReturnedwFocus">
                    <?php
                    $matReturnedFocus1 = $CraftAllTotal - $ArtefactForMatReturn;
                    $matReturnedFocus = $matReturnedFocus1 /100 * 44;
                    $matReturnedFocus = str_replace("-", "", $matReturnedFocus);
                    echo "-".number_format($matReturnedFocus); ?></td>
            </tr>
<?php
$TotalWoFocus = $usageFeeinTable + $CraftAllTotal - $matReturned;
$TotalWFocus = $usageFeeinTable + $CraftAllTotal - $matReturnedFocus;

$ProfitwoFocus = getPercentageChange($itemPrice,$TotalWoFocus);
$ProfitwoFocusSilver = $itemPrice - $TotalWoFocus;

if ($ProfitwoFocus < 0) {
    $ProfitwoFocusClass = 'danger';
} elseif ($ProfitwoFocus < 10 ) {
    $ProfitwoFocusClass = 'warning';
} elseif ($ProfitwoFocus >= 10) {
    $ProfitwoFocusClass = 'success';
}

$ProfitwFocus = getPercentageChange($itemPrice,$TotalWFocus);
$ProfitwFocusSilver = $itemPrice - $TotalWFocus;

if ($ProfitwFocus < 0) {
    $ProfitwFocusClass = 'danger';
} elseif ($ProfitwFocus < 10) {
    $ProfitwFocusClass = 'warning';
} elseif ($ProfitwFocus >= 10) {
    $ProfitwFocusClass = 'success';
}
            
?>
        </tbody>
        <tfoot>
            <tr>
                <td><p class="btn btn-secondary mt-4">Total cost</p></td>
                <td><p class="btn btn-<?php echo $ProfitwoFocusClass; ?> mt-4" id="allTotalwoFocus"><?php echo number_format($TotalWoFocus); ?></p></td>
                <td><p class="btn btn-<?php echo $ProfitwFocusClass; ?> mt-4" id="allTotalwFocus"><?php echo number_format($TotalWFocus); ?></p></td>
            </tr>
        </tfoot>
    </table>
</div>
