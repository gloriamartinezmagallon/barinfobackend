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

Route::get('generateuser','App\LoginController@generateUser')->name('app.login.generateuser');

Route::group(['middleware' => ['auth:api']], function () {
	Route::post('bares', 'App\AppController@bares')->name('app.bares');
	Route::get('baresmaspopulares', 'App\AppController@baresmaspopulares')->name('app.baresmaspopulares');
	Route::get('baresnombre', 'App\AppController@baresnombre')->name('app.baresnombre');
	Route::get('buscador', 'App\AppController@buscadorinit')->name('app.buscador');
	Route::post('addopinion', 'App\AppController@addopinion')->name('app.addopinion');
	Route::get('barinfo/{id}', 'App\AppController@barinfo')->name('app.barinfo');
	Route::post('addbar', 'App\AppController@addbar')->name('app.addbar');

	Route::post('campos/add', 'App\AppCamposController@addCampo')->name('app.campos.addcampo');
	Route::post('campos/subcampo/add', 'App\AppCamposController@addSubCampo')->name('app.campos.addsubcampo');
});