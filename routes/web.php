<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
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
    '/login/{erro?}',
    [LoginController::class, 'index']
)->name('site.login');

Route::middleware('autenticacao:default, visitante')->prefix('/app',)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('app.cliente');
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::get('/produto', [ProdutoController::class, 'index'])->name('app.produto');
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