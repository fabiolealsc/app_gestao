<?php

use App\Http\Middleware\AutenticacaoMiddleware;
use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    //TODO: Aqui se registra os grupos de Middleware
    $middleware->alias([
        'log.acesso' => LogAcessoMiddleware::class,
        'autenticacao' => AutenticacaoMiddleware::class
    ]);
    $middleware->appendToGroup('web', ['log.acesso'])->getMiddlewareGroups();
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();