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
        return $this->belongsToMany(Chapter::class, 'chapters');
    }

    protected static function boot() {
        $path = base_path().'\/public/images/';
        parent::boot();
        self::created(function ($user) {
            $path = base_path().'\/public/images/'.$user->normalized_name;
            if (!file_exists($path)) {
                mkdir($path);
            }
        });

        self::deleted(function($user){
            $dir = base_path().'\/public/images/'.$user->normalized_name;
            if (file_exists($dir)){
                FileHandler::deleteContent($dir);
            }
        });
    }
}
