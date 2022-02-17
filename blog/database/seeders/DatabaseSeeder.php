<?php

namespace Database\Seeders;

use App\Models\Status;
// use databa
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CreatorSeeder::class,
            GenreSeeder::class,
            StatusSeder::class,
            TitleSeeder::class,
            ChapterSeeder::class,
        ]);
    }
}
