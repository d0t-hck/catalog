<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'chapter_id' => 'required|exists:chapters,id',
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

    public function upload($id, Request $request) {
        $data = $this->validate($request, [
            'chapter_id' => 'required|exists:chapters,id',
            'page' => Rule::unique('pages')->where(function ($query) use ($request) {
                return $query->where('chapter_id', $request->chapter_id);
            }),
        ]);
        $chapter = Page::with('title')->findOrFail($data['chapter_id']);
        #return response()->json($page);
        // $path = base_path("/public/images/{$title->normalized_name}");
        $destinationPath = base_path("/public/images/{$chapter->title->normalized_name}/{}");
        dd($destinationPath);
        if ($request->hasFile('image')){
            $originalFilename = $request->file('image')->getClientOriginalName();
            $fileExt = end(explode('.', $originalFilename));
        }
    }

}
