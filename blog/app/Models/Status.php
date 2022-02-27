<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code', 'name'
    ];

    public static function getValidationRules($create = true) {
        return $create ? [
            'code' => 'required|numeric|unique:statuses',
            'name' => 'required|string|unique:statuses'
        ] : [
            'code' => 'numeric|unique:statuses',
            'name' => 'sometimes|string|unique:statuses'
        ];
    }
}
