<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends CommonController
{
    public function getModel(){
        return Title::class;
    }

    public function create(Request $request) {
        $data  = $this->validate($request, Title::getValidationRules());
        $title = Title::create($data);
        $title->genres()->attach($data['genres']);
        return response()->json($title, 201);
    }

}
