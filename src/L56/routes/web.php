<?php

use Illuminate\Support\Facades\DB;

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

Route::get('/L56', function () {
    return view('welcome');
});

Route::get('/L56/test', function () {
    return 'TEST';
});

Route::get('/L56/migrations', function () {
    return DB::table('migrations')->get();
});
