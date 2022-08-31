<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        System::create([
            "application_name"      => "KenaKata",
            "title_name"            => "KenaKata",
            "email"                 => "naimurrahmansagar@gmail.com",
            "phone"                 => Null,
            "city"                  => "Dhaka",
            "postal_code"           => Null,
            "address"               => Null,
            "country"               => "BD",
            "state"                 => Null,
            "app_version"           => "1.0",
            "date_format"           => "Y-m-d",
            "currency"              => "TK",
            "currency_symbol"       => "৳",
            "time_zone"             => "UTC",
        ]);
    }
}
