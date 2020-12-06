<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Parsedown;

class HomeController extends Controller
{
    public function viewMarkdown($filename) {
        $filename = $filename . '.md';
        $filepath = public_path('markdown') . DIRECTORY_SEPARATOR . $filename;

        if (file_exists($filepath)) {
            $markdown = file_get_contents($filepath);
        } else {
            abort(404);
        }

        $parser = new Parsedown();
        $html = $parser->text($markdown);

        return view('markdown', compact('filename', 'html'));
    }
}
