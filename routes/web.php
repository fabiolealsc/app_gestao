<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
use Illuminate\Support\Facades\Route;

/*      
        Quando acessado a URL '/' pelo método HTTP get é acionado o método principal() de PrincipalController 
    passando pelo middle log.acesso.
*/
Route::get('/', [PrincipalController::class, 'principal'])
->name('site.index')->middleware('log.acesso');

/*      
    Quando acessado a URL '/' pelo método HTTP get é acionado o método contato() de ContatoController.
*/
Route::get('/contato', [ContatoController::class, 'contato'])
->name('site.contato');

/*      
    Quando acessado a URL '/contato' pelo método HTTP post é acionado o método salvar() de ContatoController.
*/    
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');

/*      
    Quando acessado a URL '/sobrenos' pelo método HTTP get é acionado o método sobrenos() de SobreNosController.
*/
Route::get('/sobrenos', [SobreNosController::class, 'sobrenos'])->name('site.sobrenos');

/*      
    Quando acessado a URL '/login' pelo método HTTP post é acionado o método autenticar() de LoginController.
*/
Route::post(
    '/login',
    [LoginController::class, 'autenticar']
)->name('site.login');

/*      
    Quando acessado a URL '/login/{erro?}' pelo método HTTP get é acionado o método index() de LoginController.
*/
Route::get(
    '/login/{erro?}',
    [LoginController::class, 'index']
)->name('site.login');

/**
 * Define o middleware default e visitante para todas rotas /app.
 * Agrupa as rotas que precisam de login.
 * Aciona os métodos referentes a cada Controller de cada rota.
 */
Route::middleware('autenticacao:default, visitante')->prefix('/app',)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('app.cliente');

    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

    Route::resource('produto', ProdutoController::class);

    Route::resource('produto-detalhe', ProdutoDetalheController::class);
});

//Rota acionada quando nenhuma rota validade é requisitada
Route::fallback(function () {
    return redirect()->route('site.index');
});




/* TIPOS DE VERBOS
    Route::get($uri, $callback);
    Route::post($uri, $callback);
    Route::put($uri, $callback);
    Route::patch($uri, $callback);
    Route::delete($uri, $callback);
    Route::options($uri, $callback);
*/