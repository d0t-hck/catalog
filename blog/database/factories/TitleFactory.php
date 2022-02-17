<?php

namespace Database\Factories;

use App\Models\Title;
use App\Models\Status;
use App\Models\Author;
use App\Models\Artist;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TitleFactory extends Factory
{
    protected $model = Title::class;

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->unique()->word,
            'status_code' => Status::all()->random()->code,
            'release_year' => $this->faker->date('Y'),
            'description' => $this ->faker->text(100),
            'author_id' => Author::all()->random()->id,
            'artist_id' => Artist::all()->random()->id,
            'publisher_id' => Publisher::all()->random()->id
    	];
    }
}
