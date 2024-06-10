@extends('app.layouts.basico')

@section('titulo', 'Adicionar Produto')
    
@section('conteudo') 
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Editar produto</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route("produto.index") }}">Voltar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
               @component('app.produto._components.form_create_edit', ['produto' => $produto,'unidades' => $unidades])
               @endcomponent
            </div>
        </div>
    </div>
@endsection