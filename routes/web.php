<?php

use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrincipalController::class, 'principal'])
->name('site.index')->middleware('log.acesso');

Route::get('/contato', [ContatoController::class, 'contato'])
->name('site.contato');

    
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');

Route::get('/sobrenos', [SobreNosController::class, 'sobrenos'])->name('site.sobrenos');

Route::post(
    '/login',
    [LoginController::class, 'autenticar']
)->name('site.login');
Route::get(
    '/login',
    [LoginController::class, 'index']
)->name('site.login');

Route::middleware('autenticacao:default, visitante')->prefix('/app',)->group(function () {
    Route::get('/clientes', function () {
        return 'Clientes';
    })->name('app.clientes');
    
    Route::get('/fornecedores', function () {
        return 'Fornecedores';
    })->name('app.fornecedores');

    Route::get('/produtos', function () {
        return 'Produtos';
    })->name('app.produtos');
});

Route::fallback(function () {
    return view('site.principal');
});




/* TIPOS DE VERBOS
    Route::get($uri, $callback);
    Route::post($uri, $callback);
    Route::put($uri, $callback);
    Route::patch($uri, $callback);
    Route::delete($uri, $callback);
    Route::options($uri, $callback);
*/