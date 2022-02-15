<?php

namespace App\Models;

use App\Handlers\FileHandler;
use Directory;
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
        $path = base_path(DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
        parent::boot();
        self::creating(function ($title) {
            $title->normalized_name = self::normalizeName($title->name);
        });

        self::created(function ($title) use($path) {
            FileHandler::createFolder($path.$title->normalized_name);
        });

        self::updating(function($title) use ($path) {
            if ($title->name != $title->getOriginal('name')){
                $title->normalized_name = self::normalizeName($title->name);
                FileHandler::changeName($title->getOriginal('normalized_name'), $title->normalized_name, $path);
            }
        });

        self::deleted(function($title) use($path){
            FileHandler::deleteContent($path.$title->normalized_name);
        });
    }

    public static function getValidationRules() {
        return [
            'name' => 'required|unique:titles',
            'status_code' => 'required|exists:statuses,code',
            'release_year' => 'numeric|nullable',
            'description' => 'nullable',
            'author_id' => 'required|exists:authors,id',
            'artist_id' => 'required|exists:artists,id',
            'publisher_id' => 'required|exists:publishers,id',
            'genres' => 'required|array'
        ];
    }

    protected static function normalizeName($name) {
        return strtolower(str_replace(' ', '_', $name));
    }

}
