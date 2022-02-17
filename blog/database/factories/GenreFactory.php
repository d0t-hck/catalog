<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    protected $model = Genre::class;

    protected $genres = ['seinen', 'sport', 'fantasy', 'drama', 'romantic', 'comedy', 'isekai', 'psychology', 'horror', 'monster',
        'mystic', 'history', 'tragedy', 'mecha', 'cyberpank', 'sci-fi', 'thriller', 'adventure', 'detective', 'shonen'];

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->unique()->randomElement($this->genres)
    	];
    }
}
