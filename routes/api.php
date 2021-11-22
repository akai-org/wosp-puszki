<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/storex', function (Request $request){
    try {
        Storage::disk('local')->put('raw.txt', $request->input('total'));
        return Storage::get('raw.txt');
    } catch (Exception $e) {
        return $e->getMessage();
    }
});

Route::post('/store/json', function (Request $request){
    try {
        Storage::disk('local')->put('raw2.txt', $request->getContent());
        return Storage::get('raw2.txt');
    } catch (Exception $e) {
        return $e->getMessage();
    }
});

Route::get('/json', function () {
    return Storage::get('raw2.txt');
});


Route::get('/get', function () {
    return 'x';
});

Route::get('/raw', function () {
    header('Refresh: 3;');
    return Storage::get('raw.txt');
});
