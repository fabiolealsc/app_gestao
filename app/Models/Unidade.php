<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;
    protected $fillable = ['unidade', 'descricao'];
    //Produto::create(['nome' => 'Geladeira', 'descricao' => 'Geladeira Eletrolux 375 Litros', 'peso' => 60, 'unidade_id' => 1]);
    //Unidade::create(['unidade' => 'UN', 'descricao' => 'unidade']);
}