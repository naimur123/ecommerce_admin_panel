<?php

namespace Database\Seeders;

use App\Models\GenericStatus;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenericStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GenericStatus::create([
            "name"          => "Active",
            "created_by"    =>  1,
            "created_at"    => Carbon::now()
        ]);
    }
}
