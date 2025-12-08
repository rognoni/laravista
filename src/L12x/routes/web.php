<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;


/*Route::get('/L12x', function () {
    return view('welcome');
});*/

Route::prefix('/L12x')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/pages', [PageController::class, 'pages'])->name('pages');
});
