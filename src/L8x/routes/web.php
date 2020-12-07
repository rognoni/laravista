<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchdownController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('L8x')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });    
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'loginSubmit']);
    Route::get('register', [LoginController::class, 'register'])->name('register');
    Route::post('register', [LoginController::class, 'registerSubmit']);
    Route::get('md/{filename}', [HomeController::class, 'viewMarkdown']);
    Route::get('searchdown', [SearchdownController::class, 'index'])->name('searchdown');
    Route::get('searchdown/add', [SearchdownController::class, 'addLink'])->name('searchdownAddLink');
    Route::post('searchdown/add', [SearchdownController::class, 'addLinkSubmit']);
});

Route::prefix('L8x')->middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('L8x')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('home', function () {
        return view('home');
    })->name('home');
});

Route::prefix('L8x/admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('editor', [AdminController::class, 'editor'])->name('editor');
    Route::post('editor', [AdminController::class, 'editorSubmit']);
});

Route::get('/L8x/artisan/migrate', function () {
    Artisan::call('migrate');
    return Artisan::output();
});
