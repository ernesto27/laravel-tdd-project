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


Route::get('/register', function(){
    return view('register');
});
Route::post('/register', 'UserController@register')->name('register');

Route::get('/login', 'UserController@showLogin')->name('login');
Route::post('/login', 'UserController@login');



Route::get('/productos', 'ProductoController@index');
Route::get('/productos/{id}', 'ProductoController@show');
Route::get('/producto/create', 'ProductoController@create');
Route::post('/producto', 'ProductoController@store');
Route::get('/producto/{id}/edit', 'ProductoController@edit');
Route::put('/producto/{id}', 'ProductoController@update');

Route::post('/comentarios/productos/{id}', 'ComentarioController@store');
Route::post('/comentarios/respuesta/{id}', 'ComentarioController@storeRespuesta');


