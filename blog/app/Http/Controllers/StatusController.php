<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function list() {
        return response()->json(Status::all());
    }

    public function item($id) {
        return response()->json(Status::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'code' => 'required|numeric|unique:statuses',
            'name' => 'required|string|unique:statuses'
        ]);
        $status = Status::create($request->all());
        return response()->json($status, 201);
    }

    public function update($id, Request $request) {
        $status = Status::findOrFail($id);
        $status->update($request->all());
        return response()->json($status, 200);
    }

    public function delete($id) {
        Status::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
