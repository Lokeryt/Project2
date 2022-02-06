<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('vacs/', 'App\Http\Controllers\PostsController@allData');

Route::get('{id}', 'App\Http\Controllers\PostsController@get')->where(['id' => '[0-9]+']);

Route::post('vacs', 'App\Http\Controllers\PostsController@add');

Route::put('vacs/{id}/update', 'App\Http\Controllers\PostsController@update')->where(['id' => '[0-9]+']);

Route::delete('vacs/{id}/delete', 'App\Http\Controllers\PostsController@delete')->where(['id' => '[0-9]+']);

Route::get('vacs/sync', 'App\Http\Controllers\PostsController@sync');
