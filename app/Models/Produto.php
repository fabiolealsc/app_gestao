<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['fornecedor_id', 'nome', 'descricao', 'peso', 'unidade_id']; // define os campos que podem ser gravados no banco

    /**
     * Define o relacionamento entre produto e produto_detalhe
     * sendo esse relacionamento 1 para 1
     */
    public function produtoDetalhe()
    {
        return $this->hasOne('App\Models\ProdutoDetalhe');
    }
    /**
     * Define o relacionamento entre produto e fornecedor sendo que 
     * produto pertence a fornecedor 
     */
    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor');
    }
}