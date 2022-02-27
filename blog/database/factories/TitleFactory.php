<?php

namespace Database\Factories;

use App\Models\Title;
use App\Models\Status;
use App\Models\Creator;
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
            'author_id' => Creator::where('type','Author')->get()->random()->id,
            'artist_id' => Creator::where('type','Artist')->get()->random()->id,
            'publisher_id' => Creator::where('type','Publisher')->get()->random()->id
    	];
    }
}
