<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function list() {
        return response()->json(Artist::all());
    }

    public function item($id) {
        return response()->json(Artist::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:artists',
            'bio' => 'nullable'
        ]);
        $artist = Artist::create($request->all());
        return response()->json($artist, 201);
    }

    public function update($id, Request $request) {
        $artist = Artist::findOrFail($id);
        $artist->update($request->all());
        return response()->json($artist, 200);
    }

    public function delete($id) {
        Artist::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
