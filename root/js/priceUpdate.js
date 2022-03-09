var nf = new Intl.NumberFormat();

function PriceUpdate(a, y, itemAmount) {
    
    var x = document.getElementById(a);
    document.getElementById(y).innerHTML = parseInt(itemAmount * x.value);


    var p = document.querySelectorAll('[class="pieceOfTotal"]')
    var newPrice = 0;
    for (var i = 0; i < p.length; i++) {
        newPrice = newPrice + parseInt(p[i].innerHTML)
    };

    var CraftMaterialsTotals = document.querySelectorAll('[class="crafting_total"]');
    for(var u = 0; u < CraftMaterialsTotals.length; u++) {
        CraftMaterialsTotals[u].innerHTML = nf.format(newPrice);
        if ($('.noreturn').length > 0) {
        var noreturn = document.getElementsByClassName("noreturn")[0].value * document.getElementsByClassName("noreturn")[0].getAttribute("itemamount");
        } else {
            var noreturn = 0;
        }
        MatReturned(newPrice, noreturn);
        MatReturnedFocus(newPrice, noreturn);
    }
    
    document.getElementById('returnRatewoFocus').setAttribute('onkeyup', 'MatReturned('+newPrice+", "+noreturn+');');
    document.getElementById('returnRatewFocus').setAttribute('onkeyup', 'MatReturnedFocus('+newPrice+", "+noreturn+');');
    document.getElementById('usageFeePerc').setAttribute('onkeyup', 'CombinedCall('+newPrice+", "+noreturn+');');
    CombinedCall(newPrice, noreturn);
	};

// Combined call
function CombinedCall(newPrice, noreturn) {
    var t = document.getElementById('returnRatewoFocus').value;
    var TotalSum_MatReturned = ((newPrice - noreturn) /100 * t);
    var f = document.getElementById('returnRatewFocus').value;
    var TotalSum_MatReturnedFocus = ((newPrice - noreturn) /100 * f);
    UsageFeeCalc(newPrice, TotalSum_MatReturned);
    UsageFeeCalcFocus(newPrice, TotalSum_MatReturnedFocus);
};

// Return rate 15%
function MatReturned(newPrice, noreturn) {
    var t = document.getElementById('returnRatewoFocus').value;
    var TotalSum_MatReturned = ((newPrice - noreturn) /100 * t);
    
    document.getElementById('matReturnedwoFocus').innerHTML = '-'+nf.format(Math.abs(Math.round(TotalSum_MatReturned)));
    UsageFeeCalc(newPrice, TotalSum_MatReturned);
};

// Return rate 44%
function MatReturnedFocus(newPrice, noreturn) {
    var f = document.getElementById('returnRatewFocus').value;
    var TotalSum_MatReturnedFocus = ((newPrice - noreturn) /100 * f);
    
    document.getElementById('matReturnedwFocus').innerHTML = '-'+nf.format(Math.abs(Math.round(TotalSum_MatReturnedFocus)));
    UsageFeeCalcFocus(newPrice, TotalSum_MatReturnedFocus);
};

// UsageFee Calc to trigger TotalSummary
function UsageFeeCalc(newPrice, TotalSum_MatReturned){
    var usageFeeTable = document.querySelectorAll('[class="UsageFeeTotal"]');
    var usageFeePerc = document.getElementById('usageFeePerc').value;
    var itemValue = document.getElementById('itemValue').value;
    
    for(var w = 0; w < usageFeeTable.length; w++) {
    usageFeeTable[w].innerHTML = nf.format(Math.round(parseInt(usageFeePerc) / 20 * parseInt(itemValue)));
    }
TotalSummary(newPrice, TotalSum_MatReturned);

};

// UsageFee Calc to trigger TotalSummary w Focus
function UsageFeeCalcFocus(newPrice, TotalSum_MatReturnedFocus){
    var usageFeeTable = document.querySelectorAll('[class="UsageFeeTotal"]');
    var usageFeePerc = document.getElementById('usageFeePerc').value;
    var itemValue = document.getElementById('itemValue').value;
    
    for(var w = 0; w < usageFeeTable.length; w++) {
    usageFeeTable[w].innerHTML = nf.format(Math.round(parseInt(usageFeePerc) / 20 * parseInt(itemValue)));
    }
TotalSummaryFocus(newPrice, TotalSum_MatReturnedFocus);

};

function TotalSummary(newPrice, TotalSum_MatReturned) {
    var UFTFormatted = document.getElementsByClassName("UsageFeeTotal")[0].innerHTML;
    var UsageFeeTotal = UFTFormatted.replace(",", "");
    
    document.getElementById('allTotalwoFocus').innerHTML = nf.format(parseInt(+UsageFeeTotal + +newPrice - +TotalSum_MatReturned));
    
    var TotalSum = parseInt(+UsageFeeTotal + +newPrice - +TotalSum_MatReturned);
    var itemToCraft = document.getElementById('itemprice').getAttribute('data-itemprice');
    var itemVsMat = PercDiff(itemToCraft, TotalSum);
    if (itemVsMat < 0) {
        var ProfitwoFocusClass = 'danger'
    } else if (itemVsMat < 10) {
        var ProfitwoFocusClass = 'warning'
    } else if (itemVsMat > 10) {
        var ProfitwoFocusClass = 'success'
    }
    
    document.getElementById('allTotalwoFocus').setAttribute('class', 'btn btn-'+ProfitwoFocusClass+' mt-4');
}

function TotalSummaryFocus(newPrice, TotalSum_MatReturnedFocus) {
    var UFTFormattedFocus = document.getElementsByClassName("UsageFeeTotal")[1].innerHTML;
    var UsageFeeTotalFocus = UFTFormattedFocus.replace(",", "");
    
    document.getElementById('allTotalwFocus').innerHTML = nf.format(parseInt(+UsageFeeTotalFocus + +newPrice - +TotalSum_MatReturnedFocus));
    
    var TotalSumFocus = parseInt(+UsageFeeTotalFocus + +newPrice - +TotalSum_MatReturnedFocus);
    var itemToCraft = document.getElementById('itemprice').getAttribute('data-itemprice');
    var itemVsMat = PercDiff(itemToCraft, TotalSumFocus);
    if (itemVsMat < 0) {
        var ProfitwFocusClass = 'danger'
    } else if (itemVsMat < 10) {
        var ProfitwFocusClass = 'warning'
    } else if (itemVsMat > 10) {
        var ProfitwFocusClass = 'success'
    }
    
    
    document.getElementById('allTotalwFocus').setAttribute('class', 'btn btn-'+ProfitwFocusClass+' mt-4');
}

function PercDiff(TotalSumFocus, itemToCraft){
    var decreaseValue = TotalSumFocus - itemToCraft;

    return (decreaseValue / TotalSumFocus) * 100;
}