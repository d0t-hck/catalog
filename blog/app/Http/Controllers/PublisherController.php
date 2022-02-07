<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function list() {
        return response()->json(Publisher::all());
    }

    public function item($id) {
        return response()->json(Publisher::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:publishers',
            'info' => 'nullable'
        ]);
        $publisher = Publisher::create($request->all());
        return response()->json($publisher, 201);
    }

    public function update($id, Request $request) {
        $publisher = Publisher::findOrFail($id);
        $publisher->update($request->all());
        return response()->json($publisher, 200);
    }

    public function delete($id) {
        Publisher::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
