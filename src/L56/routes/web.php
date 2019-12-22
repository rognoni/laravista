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

Route::group(['prefix' => '/L56'], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/test', function () {
        return 'TEST';
    });
    
    Route::get('/migrations', function () {
        return DB::table('migrations')->get();
    });    

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

});
