<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    
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
            FileService::createFolder($path.$title->normalized_name);
        });

        self::updating(function($title) use ($path) {
            if ($title->name != $title->getOriginal('name')){
                $title->normalized_name = self::normalizeName($title->name);
                FileService::changeName($title->getOriginal('normalized_name'), $title->normalized_name, $path);
            }
        });

        self::deleted(function($title) use($path){
            FileService::deleteContent($path.$title->normalized_name);
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
