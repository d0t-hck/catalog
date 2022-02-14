<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function list() {
        return response()->json(Page::with('chapter.title')->get());
    }

    public function item($id) {
        return response()->json(Page::find($id));
    }

    public function create(Request $request) {
        $this->validate($request, Page::getValidationRules($request));
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

    public function upload($id, Request $request) {
        $page = Page::findOrFail($id);
        $title = $page->chapter->title->normalized_name;
        $chapter = $page->chapter->num;
        $destinationPath = base_path('public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$title.DIRECTORY_SEPARATOR.$chapter.DIRECTORY_SEPARATOR);
        if ($request->hasFile('image')) {
            $originalFilename = $request->file('image')->getClientOriginalName();
            $originalNameArr = explode('.', $originalFilename);
            $fileName = $page->page.'.'.end($originalNameArr);
            $request->file('image')->move($destinationPath, $fileName);
        }
    }

}
