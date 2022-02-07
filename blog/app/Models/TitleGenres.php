<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitleGenres extends Model
{
    protected $fillable = [
        'title_id', 'genre_id'
    ];
}
