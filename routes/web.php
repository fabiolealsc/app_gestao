<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return "Home";});
Route::get('/contato', function () {return "Contato";});
Route::get('/sobrenos', function () {return "Sobre nós";});

/* TIPOS DE VERBOS
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
*/