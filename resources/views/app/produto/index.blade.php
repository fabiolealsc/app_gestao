@extends('app.layouts.basico')

@section('titulo', $titulo)
    
@section('conteudo') 
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Produto - Listar</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                {{ $produtos->toJson() }}
                <table border="1" width='100%'>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Unidade id</th>
                            
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr> 
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                
                                <td>{{ $produto->produtoDetalhe->comprimento ?? '' }}</td>
                                <td>{{ $produto->produtoDetalhe->altura ?? '' }}</td>
                                <td>{{ $produto->produtoDetalhe->largura ?? '' }}</td>
                                
                                <td><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Visualizar</a></td>
                                <td>
                                    <form method="POST" id="form_{{$produto->id}}" action="{{ route('produto.destroy', ['produto' => $produto->id]) }}" >
                                        @method("DELETE")
                                        @csrf
                                        <a href="#" onclick="document.getElementById('form_{{$produto->id}}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $produtos->toJson() }}
                {{ $produtos->appends($request)->links() }}
                
            </div>
        </div> 
    </div>
    
@endsection