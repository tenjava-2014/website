<?php
namespace TenJava\Tools;

use Carbon\Carbon;

class BladeHelpers {

    public static function prettyDate(Carbon $date) {
        return '<time datetime="' . $date->toISO8601String() . '" title="' . $date->toDateTimeString() . '">' .
        $date->diffForHumans() . '</time>';
    }
}