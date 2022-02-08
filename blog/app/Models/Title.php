<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = [
        'name',
        'status_id',
        'release_year',
        'description',
        'author_id',
        'artist_id',
        'publisher_id'
    ];

    public function genres(){
        return $this->belongsToMany(Genre::class, 'title_genres');
    }
}
