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
        self::creating(function ($title) {
            $title->normalized_name = self::normalizeName($title->name);
        });

        self::created(function ($title) {
            $path = base_path("/public/images/{$title->normalized_name}");
            if (!file_exists($path)) {
                mkdir($path);
            }
        });

        self::updating(function($title) {
            $title->normalized_name = self::normalizeName($title->name);
            return self::renameFolder($title->getOriginal('normalized_name'), $title->normalized_name);
        });

        self::deleted(function($title){
            $dir = base_path("/public/images/{$title->normalized_name}");
            FileHandler::deleteContent($dir);
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

    protected static function renameFolder($from, $to) {
        $old = base_path("/public/images/{$from}");
        $to = base_path("/public/images/{$to}");
        return rename($old, $to);
    }

    protected static function normalizeName($name) {
        return strtolower(str_replace(' ', '_', $name));
    }

}
