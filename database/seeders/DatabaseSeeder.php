<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Region::factory()->create(['region_name' => 'WEST-NORTH']);
        Region::factory()->create(['region_name' => 'NORTH-SOUTH']);
        Region::factory()->create(['region_name' => 'SOUTH-WEST']);
    }
}
