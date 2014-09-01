<?php
/**
 * returns ordinal suffix.
 * @param int $number
 * @return string suffix
 */
function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    $mod100 = $number % 100;
    return ($mod100 >= 11 && $mod100 <= 13 ? 'th' : $ends[$number % 10]);
}