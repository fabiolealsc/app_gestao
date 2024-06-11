<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Contracts\View\View;

class SobreNosController extends Controller
{
    /*public static function middleware()
    {
        return LogAcessoMiddleware::class;
    }*/
    /**
     * Retorna a view sobre-nos
     */
    public function sobreNos(): View
    {
        return view('site.sobre-nos', ['titulo' => 'Sobre Nós']);
    }
}