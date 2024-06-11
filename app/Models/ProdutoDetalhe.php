<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    use HasFactory;
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];// define os campos que podem ser gravados no banco

    //Define que produto_detalhe pertence a produto
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}