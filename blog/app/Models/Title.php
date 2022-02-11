<?php

namespace App\Models;

use App\Handlers\FileHandler;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = [
        'name',
        'status_code',
        'release_year',
        'description',
        'author_id',
        'artist_id',
        'publisher_id',
        'normalized_name'
    ];

    public function genres(){
        return $this->belongsToMany(Genre::class, 'title_genres');
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    protected static function boot() {
        parent::boot();
        self::created(function ($title) {
            $path = base_path("/public/images/{$title->normalized_name}");
            if (!file_exists($path)) {
                mkdir($path);
            }
        });

        self::deleted(function($title){
            $dir = base_path("/public/images/{$title->normalized_name}");
            FileHandler::deleteContent($dir);
        });
    }
}
