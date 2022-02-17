<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function list() {
        return response()->json(Author::paginate(10));
    }

    public function item($id) {
        return response()->json(Author::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:authors',
            'bio' => 'nullable'
        ]);
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    public function update($id, Request $request) {
        $author = Author::findOrFail($id);
        $author->update($request->all());
        return response()->json($author, 200);
    }

    public function delete($id) {
        Author::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
