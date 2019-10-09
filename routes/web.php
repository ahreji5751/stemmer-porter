<?php

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

Route::get('/', function () {
    return view('master');
});

Route::post('/english-stemming', 'StemmingController@forEnglish');
Route::post('/russian-stemming', 'StemmingController@forRussian');
Route::post('/russian-lemmas', 'StemmingController@getLexem');
