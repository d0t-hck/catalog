<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends CommonController
{

    public function getModel() {
        return Page::class;
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
            FileService::deleteContent($destinationPath.$fileName);
            $request->file('image')->move($destinationPath, $fileName);
            $page->ext = end($originalNameArr);
        }
        $page->update();
        return response()->json('OK', 201);
    }

}
