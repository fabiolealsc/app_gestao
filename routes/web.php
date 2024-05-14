<?php

use App\Http\Controllers\PrincipalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrincipalController::class, 'principal']);

Route::get('/contato', 'ContatoController@contato');

Route::get('/sobrenos', 'SobreNosController@sobreNos');

/* TIPOS DE VERBOS
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
*/