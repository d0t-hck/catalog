<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function list() {
        return response()->json(Chapter::with('title', 'pages')->get());
    }

    public function item($id) {
        return response()->json(Chapter::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'num' => 'required|numeric',
            'name' => 'nullable|string',
            'title_id' =>'required|exists:titles,id'
        ]);
        $chapter = Chapter::create($request->all());
        return response()->json($chapter, 201);
    }

    public function update($id, Request $request) {
        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->all());
        return response()->json($chapter, 200);
    }

    public function delete($id) {
        Chapter::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
}
