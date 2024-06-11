<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     * Pega o id da pessoa que está acessando as páginas e registra
     * no banco de dados os dados de Log
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //$request - manipular
        //return $next($request);
        //response
        //dd($request);
        $ip = $request->server->get("REMOTE_ADDR");
        $rota = $request->getRequestUri();
        LogAcesso::create(['log' => "O IP $ip requisitou a rota $rota"]);
        return $next($request);
    }
}