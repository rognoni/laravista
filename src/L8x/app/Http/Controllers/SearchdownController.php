<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Searchdown;

class SearchdownController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $query = Searchdown::whereNotNull('markdown');

        if (!empty($search)) {
            $query->whereRaw("MATCH(markdown) AGAINST(? IN BOOLEAN MODE)" , [$search]);
        }

        $results = $query->orderBy('id', 'DESC')->limit(100)->get();

        return view('searchdown.index', compact('search', 'results'));
    }

    public function addLink() {
        return view('searchdown.add_link');
    }

    public function addLinkSubmit(Request $request) {
        $request->validate([
            'link' => 'required|min:12|max:190'
        ]);

        Searchdown::create($request->all());

        return redirect()->route('searchdown')->with('status', 'Link added ready for the web-spider (it can take time...)');;
    }
}
