<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     *      Quando chamado o método index o controlador irá retornar a View 
     * que está localizado em resources\views\app\fornecedor\index.blade.php
     * é passado uma variável chamada Fornecedor para a view().
     */
    public function index(): View
    {
        return view('app.fornecedor.index', ['titulo' => 'Fornecedor']);
    }

    /**
     *      A funcão lista do controlador do fornecedor irá primeiramente
     * Buscar no banco de dados os fornecedores fazendo pesquisa usando o where e
     * os campos enviados pela requisição, esses campos são recuperados pelo parâmetro
     * $request que é passado à função. Essa pesquisa também está trazendo o relacionamento
     * na tabela atravez do método produtos do Modelo Produto.
     * 
     *      É feito a paginação do resultado atravez do método paginate do framework. Escolhendo 50 resultados
     * por página.
     * 
     *      Depois os resultados são retornados com a página atravez da variável $fornecedores.
     */
    public function listar(Request $request): View
    {

        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%' . $request->input('nome') . '%')
            ->where('site', 'like', '%' . $request->input('site') . '%')
            ->where('uf', 'like', '%' . $request->input('uf') . '%')
            ->where('email', 'like', '%' . $request->input('email') . '%')
        ->paginate(50);

        return view('app.fornecedor.listar', ['titulo' => 'Fornecedor-Listar', 'fornecedores' => $fornecedores, 'request' => $request->all()]);

    }

    /*
     *  O método adicionar recebe os campos atravez do parâmetro $request,
     * faz o teste se o token veio junto com os parâmentros sendo assim 
     * identificando que a ação a ser tomada é de registro no banco depois disso
     * verifica se as entradas seguem as regras exigidas pela regra de negócio,
     * se sim faz o cadastro se não manda uma mensagem de erro à view.
     * Depois retorna a view.
     *  Ja se o token não veio e o id veio, então a ação a ser tomada é de edição dos
     * dados no banco de dados, entãousa-se o id para pesquisar o dado e atravez
     * do método update é feito a alteração usando os dados enviados pela requisição
     * e depois retorna uma mensagem de alteração feita com sucesso junto com a view.
     */
    public function adicionar(Request $request): RedirectResponse|View
    {
        $msg = '';

        if ($request->input('_token') != '' && $request->input('id') == '') {

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
                $msg = 'Edição Falhou!';
            }
            return redirect()->route('app.fornecedor.editar', ['titulo' => 'Fornecedor-Adicionar', 'msg' => $msg, 'id' => $request->input('id')]);
        }
        return view('app.fornecedor.adicionar', ['titulo' => 'Fornecedor-Adicionar', 'msg' => $msg]);
    }
    /*   O método editar recebe um id como parâmetro, faz a pesquisa desse dado no banco de
     * dados buscando o registro referente ao id e enviando os dados junto com a view
     * adicionar
     */
    public function editar($id, $msg = ''): View
    {
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['titulo' => 'Fornecedor-Editar', 'fornecedor' => $fornecedor, 'msg' => $msg]);
    }
    /* O método excluir recebe um id e atravez da pesquisa no banco
    * deleta o dado atravez do id.
    */
    public function excluir($id): string
    {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}