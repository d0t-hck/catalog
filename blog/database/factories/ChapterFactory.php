<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\Title;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    protected $model = Chapter::class;

    public function definition(): array
    {
    	return [
    	    'num' => $this->faker->randomDigit,
            'title_id' => Title::all()->random()->id,
    	];
    }
}
