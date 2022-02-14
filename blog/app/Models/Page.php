<?php

namespace App\Models;

use App\Handlers\FileHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Page extends Model
{
    protected $fillable = [
        'chapter_id', 'page'
    ];

    protected $hidden = [
        'ext'
    ];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public static function getValidationRules($request){
        return [
            'chapter_id' => 'required|exists:chapters,id',
            'page' => Rule::unique('pages')->where(function ($query) use ($request) {
                return $query->where('chapter_id', $request->chapter_id);
            }),
        ];
    }

    protected static function boot(){
        $path = base_path('public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR);
        parent::boot();
        self::updating(function($page) use($path){
            $pagePath = $path.$page->chapter->title->normalized_name.DIRECTORY_SEPARATOR.$page->chapter->num.DIRECTORY_SEPARATOR;
            return FileHandler::changeName($page->getOriginal('page').$page->ext, $page->page.$page->ext, $pagePath);
        });

        self::deleting(function($page) use($path) {
            $pagePath = $path.$page->chapter->title->normalized_name.DIRECTORY_SEPARATOR.$page->chapter->num.DIRECTORY_SEPARATOR;
                return unlink($pagePath.$page->page.$page->ext);
        });
    }
}
