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

    public static function getValidationRules($create = true) {
        return $create ? [
            'name' => 'required|unique:titles',
            'status_code' => 'required|exists:statuses,code',
            'release_year' => 'required|date_format:Y',
            'description' => 'nullable',
            'author_id' => 'required|exists:creators,id',
            'artist_id' => 'required|exists:creators,id',
            'publisher_id' => 'required|exists:creators,id',
            'genres' => 'required|array'
        ] : [
            'name' => 'required|unique:titles',
            'status_code' => 'exists:statuses,code',
            'release_year' => 'date_format:Y',
            'description' => 'nullable',
            'author_id' => 'exists:creators,id',
            'artist_id' => 'exists:creators,id',
            'publisher_id' => 'exists:creators,id',
            'genres' => 'array'
        ];
    }

    protected static function normalizeName($name) {
        return strtolower(str_replace(' ', '_', $name));
    }

}
