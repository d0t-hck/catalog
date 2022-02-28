<?php

namespace App\Http\Controllers;

use App\Models\Creator;

class CreatorController extends CommonController
{
    public function getModel(){
        return Creator::class;
    }
}
