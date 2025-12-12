<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;


class PageController extends Controller
{
    public function pages(Request $request) {
        $id = $request->input('id');
        $website = $request->input('w');
        $search = $request->input('s');

        $query = Page::query();

        if (!empty($id)) {
            $query->where('id', $id);
        }

        if (!empty($website)) {
            $query->where('url', 'LIKE', $website . '%');
        }

        if (!empty($search)) {
            $query->whereFullText('source', $search, ["mode" => "boolean"]);
        }

        $pages = $query->orderBy('id', 'DESC')->paginate(10);
        $pages_chunk = array_chunk($pages->items(), 4);
        
        return view('pages', compact('pages', 'pages_chunk', 'search', 'website', 'id'));
    }
}
