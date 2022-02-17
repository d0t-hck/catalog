<?php

namespace App\Models;

use App\Models;
use App\Handlers\FileHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    use HasFactory;

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
        $path = base_path(DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
        parent::boot();
        self::created(function ($chapter) use($path) {
            $title = Title::find($chapter->title_id, 'normalized_name');
            return FileHandler::createFolder($path.$title->normalized_nam.DIRECTORY_SEPARATOR.$chapter->num);
        });

        self::updating(function($chapter) use($path) {
            if ($chapter->num != $chapter->getOriginal('num')){
                $title = Title::find($chapter->getOriginal('title_id'), 'normalized_name');
                FileHandler::changeName($chapter->getOriginal('num'), $chapter->num, $path.$title->normalized_name.DIRECTORY_SEPARATOR);
            }
            if ($chapter->title_id != $chapter->getOriginal('title_id')){
                $oldTitle = Title::find($chapter->getOriginal('title_id'), 'normalized_name');
                $newTitle = Title::find($chapter->title_id, 'normalized_name');
                $from = $path.$oldTitle->normalized_name.DIRECTORY_SEPARATOR.$chapter->num;
                $to = $path.$newTitle->normalized_name.DIRECTORY_SEPARATOR.$chapter->num;
                FileHandler::moveFiles($from, $to);
            }
        });

        self::deleted(function($chapter){
            $title = Title::find($chapter->title_id, 'normalized_name')->normalized_name;
            $dir = base_path("/public/images/{$title}/{$chapter->num}");
            FileHandler::deleteContent($dir);
        });
    }
}
