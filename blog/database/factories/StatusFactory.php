<?php

namespace Database\Factories;

use App\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    protected $model = Status::class;

    public function definition(): array
    {
    	return [
    	    'code' => $this->faker->unique()->randomDigit,
            'name' => $this->faker->unique()->randomElement(['Announced', 'Ongoing', 'Suspended', 'Completed', 'Canceled'])
    	];
    }
}
