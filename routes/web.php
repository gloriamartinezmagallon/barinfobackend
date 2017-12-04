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

Route::get('/', 'HomeController@index')->name('home');
Route::post('/buscar', 'HomeController@buscar')->name('home.buscar');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware('auth:web')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('sincro', 'Admin\SincroController@showSincroFrom')->name('admin.sincro');
        Route::post('sincro', 'Admin\SincroController@sincro');

        Route::get('datos/campos', 'Admin\CampoController@index')->name('admin.datos.campos');
        Route::get('datos/campos/editar/{id}', 'Admin\CampoController@edit')->name('admin.datos.campos.edit');
        Route::post('datos/campos/editar/{id}', 'Admin\CampoController@update');
        Route::get('datos/campos/crear', 'Admin\CampoController@create')->name('admin.datos.campos.create');
        Route::post('datos/campos/crear', 'Admin\CampoController@store');
    });
});
