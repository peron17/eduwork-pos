<?php
namespace App\Helpers;

class Menu
{
    public const MENU = [
        'setting' => [
            'user.*',
            'unit.*',
            'payment-method.*',
            'supplier.*',
            'role.*',
            'permission.*',
        ],
        'stock' => [
            'stock.*',
            'adjustment.*',
        ],
    ];
}