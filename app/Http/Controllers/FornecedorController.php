<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index', ['titulo' => 'Fornecedor']);
    }
    public function listar(Request $request)
    {

        $fornecedores = Fornecedor::where('nome', 'like', '%' . $request->input('nome') . '%')
            ->where('site', 'like', '%' . $request->input('site') . '%')
            ->where('uf', 'like', '%' . $request->input('uf') . '%')
            ->where('email', 'like', '%' . $request->input('email') . '%')
            ->get();



        return view('app.fornecedor.listar', ['titulo' => 'Fornecedor-Listar', 'fornecedores' => $fornecedores]);
    }
    public function adicionar(Request $request)
    {
        $msg = '';
        //print_r($request->all());
        if ($request->input('_token') != '' && $request->input('id') == '') {
            //echo 'Cadastro';
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O nome deve ter no mínimo 40 caracteres',
                'uf.min' => 'O nome deve ter no mínimo 2 caracteres',
                'uf.max' => 'O nome deve ter no mínimo 2 caracteres',
                'email' => 'O campo email deve ser preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            Fornecedor::create($request->all());

            $msg = 'Cadastro realizado com sucesso!';
        }
        if ($request->input('_token') != '' && $request->input('id') != '') {

            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if ($update) {
                $msg = 'Edição realizado com sucesso!';
            } else {
                $msg = 'Edição Falhou!';;
            }
            return redirect()->route('app.fornecedor.editar', ['titulo' => 'Fornecedor-Adicionar', 'msg' => $msg, 'id' => $request->input('id')]);
        }
        return view('app.fornecedor.adicionar', ['titulo' => 'Fornecedor-Adicionar', 'msg' => $msg]);
    }
    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['titulo' => 'Fornecedor-Editar', 'fornecedor' => $fornecedor, 'msg' => $msg]);
    }
}