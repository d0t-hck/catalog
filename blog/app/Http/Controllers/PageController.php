<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function list() {
        return response()->json(Page::all());
    }

    public function item($id) {
        return response()->json(Page::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'chapter_id' => 'required|exists:chapters, id',
            'page' => 'required|numeric'
        ]);
        $page = Page::create($request->all());
        return response()->json($page, 201);
    }

    public function update($id, Request $request) {
        $page = Page::findOrFail($id);
        $page->update($request->all());
        return response()->json($page, 200);
    }

    public function delete($id) {
        Page::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
