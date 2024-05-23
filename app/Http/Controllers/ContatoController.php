<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato()
    {
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        /*echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        print_r($request->input('nome'));
        */
        /*
        $contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');
        
        //print_r($contato->getAttributes());
        $contato->save();
        */

        //$contato = new SiteContato();
        //$contato->create($request->all());

        $request->validate([
            'nome'               => 'required|min:3|max:40|unique:site_contatos', // nomes com no mínimo 3 caracteres
            'telefone'           => 'required',
            'email'              => 'email',
            'motivo_contatos_id' => 'required', 'mensagem'           => 'required|max:2000'
        ], [
            'nome.required'     => 'O campo nome é obrigatório',
            'nome.min'          => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max'          => 'O campo nome pode ter no máximo 40 caracteres',
            'nome.unique'       => 'Esse nome ja foi cadastrado',
            'telefone.required' => 'O campo telefone é obrigatório',
            'email.email'       => 'Formato de email inválido',
            'motivo_contatos_id' => 'É obrigatório registrar o motivo do contato',
            'mensagem.required' => 'O campo mensagem não pode estar vazio',
            'mensagem.max'      => 'O campo mensagem pode ter no máximo 2000 campos.'
        ]);
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}