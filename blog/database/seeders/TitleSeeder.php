<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Title;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Title::factory()
            ->count(10)
            ->create();
        foreach (Title::all() as $title) {
            $genres = Genre::inRandomOrder()->take(rand(1,3))->pluck('id');
            $title->genres()->attach($genres);
        }
    }
}
