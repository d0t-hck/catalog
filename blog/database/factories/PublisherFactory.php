<?php

namespace Database\Factories;

use App\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    protected $model = Publisher::class;

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->unique()->company,
            'info' => $this->faker->sentence
    	];
    }
}
