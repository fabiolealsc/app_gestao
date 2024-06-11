<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Separa as palavras pelo camel case
//Site_Contato
//site_contato
//site_contatos


class SiteContato extends Model
{
    use HasFactory;
    //Define os campo que podem ser gravados no banco
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'motivo_contatos_id',
        'mensagem'
    ];
}