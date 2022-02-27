<?php

namespace Database\Seeders;

use App\Models\Creator;
use Illuminate\Database\Seeder;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Creator::factory()
            ->count(20)
            ->create(['type' => 'Author']);
            
        Creator::factory()
            ->count(20)
            ->create(['type' => 'Artist']);

        Creator::factory()
            ->count(10)
            ->create(['type' => 'Publisher']);
    }
}
