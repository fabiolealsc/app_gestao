<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\Unidade;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * O método index de produto relaciona produto_detalhe e fornecedor 
     * faz a pequisa dos detalhes e retorna tudo com a view produto index
     */
    public function index(Request $request): View
    {
        $produtos = Produto::with(['produtoDetalhe', 'fornecedor'])->paginate(10);
        
        /*
        foreach ($produtos as $key => $produto) {
            $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();
            if (isset($produtoDetalhe)) {
                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
                $produtos[$key]['largura'] = $produtoDetalhe->largura;
                $produtos[$key]['altura'] = $produtoDetalhe->altura;
            }
        }*/

        return view('app.produto.index', ['titulo' => 'Produto-Listar', 'produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Mostra a view para criar novo produto, mas primeiro
     * busca as unidade e os fornecedores no banco de dados para enviar
     * para a view.
     */
    public function create(): View
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Verifica as entradas e grava o dado no banco de dados se todas as
     * regras forem obedecidas, senão retorna os erros para a ultima pagina
     */
    public function store(Request $request): string
    {
        $regras = [
            'fornecedor_id' => 'exists:fornecedores,id',
            'nome'          => 'required|min:3|max:40',
            'descricao'     => 'required|min:3|max:2000',
            'peso'          => 'required|integer',
            'unidade_id'    => 'exists:unidades,id'
        ];

        $feedback = [
            'fornecedor_id.exists'  => 'Selecione um fornecedor válido',
            'required'              => 'O campo :attribute deve ser preenchido',
            'nome.min'              => 'O nome deve ter no mínimo 3 caracteres',
            'nome.max'              => 'O nome deve ter no mínimo 40 caracteres',
            'descricao.min'         => 'O nome deve ter no mínimo 2 caracteres',
            'descricao.max'         => 'O nome deve ter no mínimo 2000 caracteres',
            'peso.integer'          => 'O campo peso deve ser preenchido com número inteiro',
            'unidade_id.exists'     => 'O campo unidade deve ser preenchido corretamente'
        ];

        $request->validate($regras, $feedback);

        Produto::create($request->all());

        return redirect()->route('produto.index');
    }

    /**
     * Mostra detalhes de um produto
     */
    public function show(Produto $produto): View
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Mostra a view edite passando o resultado da busca de unidades e fornecedores
     */
    public function edit(Produto $produto): View
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
        //return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Valida as entradas e depois grava as mudanças no banco de dados
     */
    public function update(Request $request, Produto $produto): string
    {
        //print_r($request->all()); //payload
        //print_r($produto->getAttributes()); // instancia do objeto no estado anterior
        $regras = [
            'fornecedor_id' => 'exists:fornecedores,id',
            'nome'          => 'required|min:3|max:40',
            'descricao'     => 'required|min:3|max:2000',
            'peso'          => 'required|integer',
            'unidade_id'    => 'exists:unidades,id'
        ];

        $feedback = [
            'fornecedor_id.exists'  => 'Selecione um fornecedor válido',
            'required'              => 'O campo :attribute deve ser preenchido',
            'nome.min'              => 'O nome deve ter no mínimo 3 caracteres',
            'nome.max'              => 'O nome deve ter no mínimo 40 caracteres',
            'descricao.min'         => 'O nome deve ter no mínimo 2 caracteres',
            'descricao.max'         => 'O nome deve ter no mínimo 2000 caracteres',
            'peso.integer'          => 'O campo peso deve ser preenchido com número inteiro',
            'unidade_id.exists'     => 'O campo unidade deve ser preenchido corretamente'
        ];

        $request->validate($regras, $feedback);
        
        $produto->update($request->all());
        
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove um registro buscado atravez do id
     */
    public function destroy(Produto $produto): string
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}