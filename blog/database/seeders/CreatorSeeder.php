<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Author;
use App\Models\Publisher;
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
        Author::factory()
            ->count(20)
            ->create();
            
        Artist::factory()
            ->count(20)
            ->create();

        Publisher::factory()
            ->count(10)
            ->create();
    }
}
