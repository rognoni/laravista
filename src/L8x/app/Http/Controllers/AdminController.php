<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function editor() {
        $filename = '.env';
        $filetext = file_get_contents(base_path() . DIRECTORY_SEPARATOR . $filename);

        return view('admin.editor', compact('filename', 'filetext'));
    }

    public function editorSubmit(Request $request) {
        $filename = $request->input('filename');
        $filepath = base_path() . DIRECTORY_SEPARATOR . $filename;
        $message = null;
        $filetext = null;
        
        if ($request->input('execute') == 'open') {
            if (file_exists($filepath)) {
                $filetext = file_get_contents($filepath);
                $message = 'File opened successfully!';    
            }
        } else {
            // save
            $filetext = $request->input('filetext');
            file_put_contents($filepath, $filetext);
            $message = 'File saved successfully!';
        }

        return view('admin.editor', compact('message', 'filename', 'filetext'));
    }
}
