<?php

/**
 * Return price in Rupiah format
 */

use Carbon\Carbon;

if (!function_exists('rupiahPrice')) {
    function rupiahPrice(float $price)
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
}

/**
 * Show status true or false with badge class
 */
if (!function_exists('labeledStatus')) {
    function labeledStatus(int $status)
    {
        $text = 'Inactive';
        $class = 'bg-secondary';
        if ($status == 1) {
            $class = 'bg-primary';
            $text = 'Active';
        }
        return "<span class=\"badge $class\">$text</span>";
    }
}

/**
 * Showing date in indonesian style
 */
if (!function_exists('localDate')) {
    function localDate(string $date)
    {
        return Carbon::parse($date)->format('d m Y H:i');
    }
}
