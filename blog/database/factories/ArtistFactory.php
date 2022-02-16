<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    protected $model = Artist::class;

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->unique()->name,
            'bio' => $this->faker->sentence
    	];
    }
}
