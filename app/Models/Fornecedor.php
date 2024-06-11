<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//fornedors
//fornecedores


class Fornecedor extends Model
{
    use SoftDeletes; // Usando para não excluir totalmente o dado do banco de dados, somente desativar o dado
    use HasFactory;
    protected $table = 'fornecedores'; // Define o nome da tabela do banco de dados, pois o plural não se aplica
    // Define os dados que podem ser gravados no banco
    protected $fillable = [
        'nome',
        'site',
        'uf',
        'email'
    ];
    /**
     * Define o relacionamento de 1 para muitos entre fornecedor e produto
     * definindo o que fornecedor tem muitos produtos, definindo a foreingKey fonecedor_id na 
     * tabela produtos pegando o da de id do fornecedor.
     */
    public function produtos()
    {
        return $this->hasMany('App\Models\Produto', 'fornecedor_id', 'id');
        //return $this->hasMany('App\Models\Produto');
    }
}