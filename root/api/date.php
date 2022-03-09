<?php

function dateDiff($date)
{
    $mydate= gmdate("Y-m-d H:i:s");
    $theDiff="";
    $datetime1 = date_create($date);
    $datetime2 = date_create($mydate);
    $interval = date_diff($datetime1, $datetime2);
    $min=$interval->format('%i');
    $sec=$interval->format('%s');
    $hour=$interval->format('%h');
    $mon=$interval->format('%m');
    $day=$interval->format('%d');
    $year=$interval->format('%y');
    if($interval->format('%i%h%d%m%y')=="00000") {
        return $sec." seconds ago";
    } else if($interval->format('%h%d%m%y')=="0000"){
        return $min." minutes ago";
    } else if($interval->format('%d%m%y')=="000"){
        return $hour." hours ago";
    } else if($interval->format('%m%y')=="00"){
        return $day." days ago";
    } else if($interval->format('%y')=="0"){
        return $mon." months ago";
    } else{
        return $year." years ago";
    }    
}
?>