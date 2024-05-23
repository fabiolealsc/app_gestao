<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SobreNosController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return LogAcessoMiddleware::class;
    }
    public function sobreNos()
    {
        return view('site.sobre-nos', ['titulo' => 'Sobre Nós']);
    }
}