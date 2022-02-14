<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Page extends Model
{
    protected $fillable = [
        'chapter_id', 'page'
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
}
