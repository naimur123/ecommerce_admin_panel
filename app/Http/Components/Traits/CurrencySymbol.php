<?php

namespace App\Http\Components\Traits;

trait CurrencySymbol{

    /**
     * Assign the Currency Symbol Here
     */
    protected function symbol(){
       return  [
        // "BDT"   =>  "৳", // Bangladeshi Taka
        // 'USD'   => '$', // US Dollar
        // 'CAD'   => '$', // CAD Dollar
        // 'EUR'   => '€', // Euro
        // 'CRC'   => '₡', // Costa Rican Colón
        // 'GBP'   => '£', // British Pound Sterling
        // 'INR'   => '₹', // Indian Rupee
        // 'JPY'   => '¥', // Japanese Yen
        // 'KRW'   => '₩', // South Korean Won
        // 'NGN'   => '₦', // Nigerian Naira
        // 'PHP'   => '₱', // Philippine Peso
        // 'PLN'   => 'zł', // Polish Zloty
        // 'PYG'   => '₲', // Paraguayan Guarani
        // 'THB'   => '฿', // Thai Baht
        // 'UAH'   => '₴', // Ukrainian Hryvnia
        // 'VND'   => '₫', // Vietnamese Dong,
        // "SAR"   => "﷼", // Saudi riyal
        // "AED"   => "د.إ", // United Arab Emirates dirham 
        ['name' => "BDT", 'symbol' => "৳"],
        ['name' => "USD", 'symbol' => "$"],
        ['name' => "CAD", 'symbol' => "$"],
        ['name' => "EUR", 'symbol' => "€"],
        ['name' => "CRC", 'symbol' => "₡"],
        ['name' => "GBP", 'symbol' => "£"],
        ['name' => "JPY", 'symbol' => "¥"],
        ['name' => "KRW", 'symbol' => "₩"],
        ['name' => "AED", 'symbol' => "د.إ"],
        ['name' => "SAR", 'symbol' => "﷼"],
       
    ];
  }
}