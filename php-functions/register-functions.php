<?php

function leap_year_check($year){
    if (($year % 4 == 0 && $year %100 != 0) || $year % 400 == 0) {
        return true;
    } else {
        return false;
    }
}

function validate_dob($month, $day, $year) {

    $months_31 = [1, 3, 5, 7, 8, 10, 12];

    $feb_days = leap_year_check($year) ? 29 : 28;

    // Validate February
    if ($month == 2 && $day > $feb_days) { 
        return false;
    } 

    // Validate rest of months
    if (!in_array($month, $months_31, true) && $day > 30) {
        return false;
    } else {
        return true;
    }
}

?>