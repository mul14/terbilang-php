<?php

use Nasution\Terbilang;

if (!function_exists('terbilang')) {
    function terbilang($value) {
        return Terbilang::convert($value);
    }
}
