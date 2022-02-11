<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class CommonController extends Controller
{
    abstract protected function getModel();

    public function list() {
        return response()->json(($this->getModel())::all(), 200);
    }
}
