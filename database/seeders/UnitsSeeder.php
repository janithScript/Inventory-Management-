<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    public function run()
    {
        $units = [
            ['name' => 'Kilogram', 'symbol' => 'kg'],
            ['name' => 'Meter', 'symbol' => 'm'],
            ['name' => 'Centimeter', 'symbol' => 'cm'],
            ['name' => 'Pieces', 'symbol' => 'pcs'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
