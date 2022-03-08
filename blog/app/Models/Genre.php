<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];
    public function titles() {
        return $this->belongsToMany(Title::class);
    }

    public static function getValidationRules($create = true){
        return $create ? [
            'name' => 'required|unique:genres'
        ] : [
            'name' => 'unique:genres'
        ];
    }
}
