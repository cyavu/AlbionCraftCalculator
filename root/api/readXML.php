<?php
$xml = simplexml_load_file( "XML/items.xml" ) or die( "Error: Cannot create object" );

echo "INSERT INTO `craft`(`uniquename`, `craftitem1`, `craftitem1_amount`, `craftitem1_maxreturnamount`, `craftitem2`, `craftitem2_amount`, `craftitem2_maxreturnamount`, `craftitem3`, `craftitem3_amount`, `craftitem3_maxreturnamount`, `craftitem4`, `craftitem4_amount`, `craftitem4_maxreturnamount`, `craftitem5`, `craftitem5_amount`, `craftitem5_maxreturnamount`, `craftitem6`, `craftitem6_amount`, `craftitem6_maxreturnamount`, `focus`) VALUES";
foreach ( $xml as $equipmentitem )  {
    
    // Check of item craftable is, zo niet dan tonen we deze niet
    if ( isset($equipmentitem->craftingrequirements->craftresource) ) {
        
    // Uniquename
    echo "<br>('" . $equipmentitem['uniquename'] . "',";
    echo " ";
    // Crafting resources
    foreach ($equipmentitem->craftingrequirements->craftresource as $craftitem ) {
    echo "'" . $craftitem['uniquename'] . "', ";
    echo "'" . $craftitem['count'] . "', ";
    if ( !isset($craftitem['maxreturnamount']) ) {
        echo "'1', ";
        }
            else {
                echo "'" . $craftitem['maxreturnamount'] . "', ";
            };
    };
    // NULL invullen voor lege craftitem velden
    $craftitems = count($equipmentitem->craftingrequirements->craftresource);
    if ( ( $craftitems ) == 1 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,";
    }
    elseif ( ( $craftitems ) == 2 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,";
    }
    elseif ( ( $craftitems ) == 3 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,";
            }
    elseif ( ( $craftitems ) == 4 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL,";
    }
    elseif ( ( $craftitems ) == 5 ) {
        echo "NULL, NULL, NULL,";
    };
    echo " ";
    // craftingfocus
    if ( !isset($equipmentitem->craftingrequirements['craftingfocus']) ) {
        echo "NULL),";
    } else {
        echo "'" . $equipmentitem->craftingrequirements['craftingfocus'] . "'),";
    }
    // --------------------------------------- Voor de .1 t/m .3 tiers
    foreach ($equipmentitem->enchantments->enchantment as $enchantmentItem ) {
    // Uniquename @TIER    
    echo "<br>('" . $equipmentitem['uniquename'] . "@" . $enchantmentItem['enchantmentlevel'] . "',";
    echo " ";
    // Crafting resources
    foreach ($enchantmentItem->craftingrequirements->craftresource as $craftitemTier ) {
    echo "'" . $craftitemTier['uniquename'];
        if ( !isset($craftitemTier['enchantmentlevel']) ) {
        echo "', ";
        }
        else {
        echo    "@" . $craftitemTier['enchantmentlevel'] . "', ";
        }
        "@" . $craftitemTier['enchantmentlevel'] . "', ";
    echo "'" . $craftitemTier['count'] . "', ";
    if ( !isset($craftitemTier['maxreturnamount']) ) {
        echo "'1', ";
        }
            else {
                echo "'" . $craftitemTier['maxreturnamount'] . "', ";
            };
    };
    // NULL invullen voor lege craftitem velden
    $craftitemsTier = count($enchantmentItem->craftingrequirements->craftresource);
    if ( ( $craftitemsTier ) == 1 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,";
    }
    elseif ( ( $craftitemsTier ) == 2 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,";
    }
    elseif ( ( $craftitemsTier ) == 3 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,";
            }
    elseif ( ( $craftitemsTier ) == 4 ) {
        echo "NULL, NULL, NULL, NULL, NULL, NULL,";
    }
    elseif ( ( $craftitemsTier ) == 5 ) {
        echo "NULL, NULL, NULL,";
    };
    echo " ";
    // craftingfocus
    if ( !isset($enchantmentItem->craftingrequirements['craftingfocus']) ) {
        echo "NULL)";
    } else {
        echo "'" . $equipmentitem->craftingrequirements['craftingfocus'] . "'),";
    }
    }
}
}
?>