<?php

// https://www.php.net/manual/en/function.number-format.php

function intToTrucatedStr($n) {
    // first strip any formatting;
    $n = (0+str_replace(",","",$n));

    // is this a number?
    if(!is_numeric($n)) return false;

    // now filter it;
    if($n>1000000000000) return round(($n/1000000000000),1).' t';
    else if($n>1000000000) return round(($n/1000000000),1).' b';
    else if($n>1000000) return round(($n/1000000),1).' m';
    else if($n>1000) return round(($n/1000),1).' k';

    return number_format($n);
}