<?php

namespace App\Http\Controllers;

use App\Models\Status;

class StatusController extends CommonController
{
    protected function getModel() {
        return Status::class;
    }
}