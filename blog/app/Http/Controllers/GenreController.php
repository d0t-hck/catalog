<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends CommonController
{
    public function getModel(){
        return Genre::class;
    }

}
