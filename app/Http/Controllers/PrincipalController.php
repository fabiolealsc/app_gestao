<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use Illuminate\Contracts\View\View;

class PrincipalController extends Controller
{
    /**
     * O método principal pesquisa os motivos contato no banco
     * e retorna com a view principal.
     */
    public function principal(): View
    {
        $motivo_contatos = MotivoContato::all();
        return view('site.principal', ['titulo' => 'Home', 'motivo_contatos' => $motivo_contatos]);
    }
}