<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Creator extends Model
{
    use HasFactory;

    protected static $types = ['Author', 'Artist', 'Publisher'];

    protected $fillable = [
        'name', 'info', 'type'
    ];
    
    public function getValidationRules($create = true) {
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
