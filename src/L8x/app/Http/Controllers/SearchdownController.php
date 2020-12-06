<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Searchdown;

class SearchdownController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $query = Searchdown::query();

        if (!empty($search)) {
            $query->whereRaw("MATCH(markdown) AGAINST(? IN BOOLEAN MODE)" , [$search]);
        }

        $results = $query->orderBy('id', 'DESC')->limit(100)->get();

        return view('searchdown.index', compact('search', 'results'));
    }
}
