<?php

namespace App\Http\Components\Traits;

trait CurrencySymbol{

    /**
     * Get Currency Symbol
     */
    protected function getCurrencySymbol($currency = "BDT"){
        return $this->currency_symbol_sign[$currency];
    }

    /**
     * Assign the Currency Symbol Here
     */
    protected $currency_symbol_sign = [
        "BDT"   =>  "৳", // Bangladeshi Taka
        'USD'   => '$', // US Dollar
        'CAD'   => '$', // CAD Dollar
        'EUR'   => '€', // Euro
        'CRC'   => '₡', // Costa Rican Colón
        'GBP'   => '£', // British Pound Sterling
        'INR'   => '₹', // Indian Rupee
        'JPY'   => '¥', // Japanese Yen
        'KRW'   => '₩', // South Korean Won
        'NGN'   => '₦', // Nigerian Naira
        'PHP'   => '₱', // Philippine Peso
        'PLN'   => 'zł', // Polish Zloty
        'PYG'   => '₲', // Paraguayan Guarani
        'THB'   => '฿', // Thai Baht
        'UAH'   => '₴', // Ukrainian Hryvnia
        'VND'   => '₫', // Vietnamese Dong,
        "SAR"   => "﷼", // Saudi riyal
        "AED"   => "د.إ", // United Arab Emirates dirham     
    ];
}