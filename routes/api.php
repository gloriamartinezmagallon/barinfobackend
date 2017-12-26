<?php

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});*/

Route::post('bares', 'App\AppController@bares')->name('app.bares');
Route::get('buscador', 'App\AppController@buscadorinit')->name('app.buscador');
Route::post('addopinion', 'App\AppController@addopinion')->name('app.addopinion');
Route::get('barinfo/{id}', 'App\AppController@barinfo')->name('app.barinfo');
