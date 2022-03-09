<div class="table-responsive">
    <table width="100%" cellspacing="0">
        <tbody>
            <tr>
                <td>Usage fee<footer class="blockquote-footer">of crafting station</footer></td>
                <td><div class="input-group input-grp-lg ml-4 w-75">
                    <input type="hidden" name="itemValue" id="itemValue" value="<?php echo $CraftItemValueTotal; ?>">
                    <input name="usageFeePerc" type="text" value="50" onkeyup="CombinedCall(<?php echo $CraftAllTotal.", ".$ArtefactForMatReturn; ?>);" id="usageFeePerc" class="form-control text-right">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                    </div></td>
            </tr>
            <tr>
                <td>Return rate<footer class="blockquote-footer">without focus</footer></td>
                <td><div class="input-group input-grp-lg ml-4 w-75">
                    <input name="returnRatewoFocus" type="text" value="15" onkeyup="MatReturned(<?php echo $CraftAllTotal.", ".$ArtefactForMatReturn; ?>);" id="returnRatewoFocus" class="form-control text-right">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                    </div></td>
            </tr>
            <tr>
                <td>Return rate<footer class="blockquote-footer">with focus</footer></td>
                <td><div class="input-group input-grp-lg ml-4 w-75">
                    <input name="returnRatewFocus" type="text" value="44" onkeyup="MatReturnedFocus(<?php echo $CraftAllTotal.", ".$ArtefactForMatReturn; ?>);" id="returnRatewFocus" class="form-control text-right">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                    </div></td>
            </tr>
            <!-- <tr>
                <td>Spec<footer class="blockquote-footer">crafting specialist</footer></td>
                <td><div class="input-group input-grp-lg ml-4 w-75">
                    <input name="specCraftSpecialist" type="text" value="5" onkeyup="" id="specCraftSpecialist" class="form-control text-right">
                    <div class="input-group-append">
                        <span class="input-group-text">S</span>
                    </div>
                    </div></td>
            </tr>
            <tr>
                <td>Count<footer class="blockquote-footer">amount to craft</footer></td>
                <td><div class="input-group input-grp-lg ml-4 w-75">
                    <input name="amountToCraft" type="text" value="1" onkeyup="" id="amountToCraft" class="form-control text-right">
                    <div class="input-group-append">
                        <span class="input-group-text">*</span>
                    </div>
                    </div></td>
            </tr> -->
        </tbody>
    </table>
</div>
