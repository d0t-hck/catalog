<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends CommonController
{
    public function getModel(){
        return Genre::class;
    }
    // public function list() {
    //     return response()->json(Genre::all());
    // }

    // public function item($id) {
    //     return response()->json(Genre::find($id));
    // }

    // public function create(Request $request) {
    //     $this->validate($request, [
    //         'name' => 'required|unique:genres'
    //     ]);
    //     $genre = Genre::create($request->all());
    //     return response()->json($genre, 201);
    // }

    // public function update($id, Request $request) {
    //     $genre = Genre::findOrFail($id);
    //     $genre->update($request->all());
    //     return response()->json($genre, 200);
    // }

    // public function delete($id) {
    //     Genre::findOrFail($id)->delete();
    //     return response('Deleted Successfully', 200);
    // }

}
