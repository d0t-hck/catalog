<?php

namespace App\Models;

use App\Models;
use App\Handlers\FileHandler;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'num', 'name', 'title_id'
    ];

    public function title(){
        return $this->belongsTo(Title::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }

    protected static function boot() {
        parent::boot();
        self::created(function ($chapter) {
            $title = Title::find($chapter->title_id, 'normalized_name');
            $path = base_path("/public/images/{$title->normalized_name}/{$chapter->num}");
            if (!file_exists($path)) {
                mkdir($path);
            }
        });

        self::deleted(function($chapter){
            $title = Title::find($chapter->title_id, 'normalized_name')->normalized_name;
            $dir = base_path("/public/images/{$title}/{$chapter->num}");
            FileHandler::deleteContent($dir);
        });
    }
}
