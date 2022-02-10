<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'num', 'name', 'title_id'
    ];

    public function title(){
        return $this->belongsTo(Title::class);
    }
}
