<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function list() {
        return response()->json(Title::with('genres')->paginate(10));
    }

    public function item($id) {
        return response()->json(Title::find($id));
    }

    public function create(Request $request) {
        $data  = $this->validate($request, [
            'name' => 'required|unique:titles',
            'status_code' => 'required|exists:statuses,code',
            'release_year' => 'numeric|nullable',
            'description' => 'nullable',
            'author_id' => 'required|exists:authors,id',
            'artist_id' => 'required|exists:artists,id',
            'publisher_id' => 'required|exists:publishers,id',
            'genres' => 'required|array'
        ]);
        $data['normalized_name'] = strtolower(str_replace(' ', '_', $data['name']));
        $title = Title::create($data);
        $title->genres()->attach($data['genres']);
        return response()->json($title, 201);
    }

    public function update($id, Request $request) {
        $title = Title::findOrFail($id);
        $title->update($request->all());
        return response()->json($title, 200);
    }

    public function delete($id) {
        Title::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
