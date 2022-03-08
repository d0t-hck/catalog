<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

/**
 * App\Models\Creator
 * 
 * @property string $type
 */
class Creator extends Model
{
    use HasFactory;

    protected static $types = ['Author', 'Artist', 'Publisher'];

    protected $fillable = [
        'name', 'info', 'type'
    ];

    protected $with = ['titles'];

    public function titles() {
        return $this->belongsTo(Title::class, 'author_id');
    }
    
    public static function getValidationRules($create = true) {
        return $create ? [
            'name' => 'required|string|unique:creators',
            'info' => 'nullable',
            'type' => [
                'required',
                'string',
                Rule::in(self::$types)
            ]
        ] : [
            'name' => 'string|unique:creators',
            'info' => 'nullable',
            'type' => [
                'string',
                Rule::in(self::$types)
            ]
            ];
    }
}
