<?php

use Nasution\Terbilang;

if (!function_exists('terbilang')) {
    function terbilang($value) {
        return Terbilang::convert($value);
    }
}

if (!function_exists('tersebut')) {
    function tersebut($value) {
        return Terbilang::revert($value);
    }
}
