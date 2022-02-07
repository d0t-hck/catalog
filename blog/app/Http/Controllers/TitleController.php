<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function list() {
        return response()->json(Title::all());
    }

    public function item($id) {
        return response()->json(Title::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:titles',
            'status' => 'required|numeric|exists:statuses, code',
            'title_id' =>'required|exists:titles, id',
            'release_year' => 'numeric|nullable',
            'description' => 'nullable',
            'author_id' => 'required|exists:authors, id',
            'artist_id' => 'required|exists:artists, id',
            'publisher_id' => 'required|exists:publishers, id'
        ]);
        $title = Title::create($request->all());
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
