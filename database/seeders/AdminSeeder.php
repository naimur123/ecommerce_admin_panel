<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin::create([
        //     "name"              => "Admin",
        //     "email"             => "admin@admin.com",
        //     "password"          => bcrypt("admin@admin.com"),
        //     "email_verified_at" => now(),
        //     "remember_token"    => Str::random(32),
        // ]);
       
        Admin::create([
            "name"              => "Sagar",
            "email"             => "sagar@admin.com",
            "password"          => bcrypt("admin@admin.com"),
            "email_verified_at" => now(),
            "remember_token"    => Str::random(32),
        ]);
    }
}
