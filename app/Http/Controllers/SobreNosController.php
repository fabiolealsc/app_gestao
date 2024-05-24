<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;


class SobreNosController extends Controller
{
    /*public static function middleware()
    {
        return LogAcessoMiddleware::class;
    }*/
    public function sobreNos()
    {
        return view('site.sobre-nos', ['titulo' => 'Sobre Nós']);
    }
}