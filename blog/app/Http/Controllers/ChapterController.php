<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends CommonController
{

    public function getModel(){
        return Chapter::class;
    }
    
}
