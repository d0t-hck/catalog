<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    public function titles() {
        return $this->belongsToMany(Title::class, 'title_genres');
    }
}
