<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');

Route::apiResource('/tareas','API\TareaController')->middleware(['auth:api','Cors']);

Route::post('/tareasall','API\TareaController@indexDatos')->middleware(['auth:api','Cors']);
Route::post('/tareainsert','API\TareaController@update_custom')->middleware(['auth:api','Cors']);
Route::post('/tareadelete','API\TareaController@destroyed')->middleware(['auth:api','Cors']);