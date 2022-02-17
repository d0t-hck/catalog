<?php

namespace App\Models;

use App\Handlers\FileHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Page extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'chapter_id', 'page'
    ];

    protected $hidden = [
        'ext'
    ];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public static function getValidationRules($chapterId){
        return [
            'chapter_id' => 'required|exists:chapters,id',
            'page' => Rule::unique('pages')->where(function ($query) use ($chapterId) {
                return $query->where('chapter_id', $chapterId);
            }),
        ];
    }

    protected static function boot(){
        $path = base_path('public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR);
        parent::boot();
        self::updating(function($page) use($path){
            $originalPage = $page->getOriginal('page');
            $originalChapter = $page->getOriginal('chapter_id');
            if ($page->page != $originalPage) {
                $pagePath = $path.$page->chapter->title->normalized_name.DIRECTORY_SEPARATOR.$page->chapter->num.DIRECTORY_SEPARATOR;
                FileHandler::changeName($originalPage.'.'.$page->ext, $page->page . '.' . $page->ext, $pagePath);
            }
            if ($page->chapter_id != $originalChapter) {
                $chapter = Chapter::find($originalChapter);
                $from = $path.$chapter->title->normalized_name.DIRECTORY_SEPARATOR.$chapter->num.DIRECTORY_SEPARATOR.$page->page.'.'.$page->ext;
                $to = $path.$page->chapter->title->normalized_name.DIRECTORY_SEPARATOR.$page->chapter->num.DIRECTORY_SEPARATOR.$page->page.'.'.$page->ext;
                FileHandler::moveFiles($from, $to);
            }
        });

        self::deleting(function($page) use($path) {
            $pagePath = $path.$page->chapter->title->normalized_name.DIRECTORY_SEPARATOR.$page->chapter->num.DIRECTORY_SEPARATOR;
            return FileHandler::deleteContent($pagePath.$page->page.'.'.$page->ext);
        });
    }
}
