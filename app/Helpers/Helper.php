<?php

namespace App\Helpers;

class Helper
{
    public static function is_super_admin()
    {
        if (auth()->check() && auth()->user()->role == "superadmin"){
            return true;
        }
        return false;
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        } else {
            return $number;
        }
    }
}
