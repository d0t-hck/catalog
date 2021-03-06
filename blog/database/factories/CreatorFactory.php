<?php

namespace Database\Factories;

use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorFactory extends Factory
{
    protected $model = Creator::class;

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->unique()->name,
            'info' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['Author', 'Artist', 'Publisher'])
    	];
    }
}
