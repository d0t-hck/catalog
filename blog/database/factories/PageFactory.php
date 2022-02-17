<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
    	return [
    	    'chapter_id' => Chapter::all()->random()->id,
            'page' => $this->faker->unique()->randomDigit,
    	];
    }
}
