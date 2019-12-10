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


#llibros
Route::get('/libros', 'ApiLibroController@index');
Route::get('/libros/nombreAutor/{slug}','LibrosControllers@motrarPorAutor')->name('LibrosControllers');
Route::get('/libros/genero/{slug}','LibrosControllers@mostrarPorGenero')->name('LibrosControllers');
