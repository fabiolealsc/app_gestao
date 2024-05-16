<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $contato = new SiteContato();
            $contato->nome = 'contato';
            $contato->telefone = '"(' . rand(0, 9) . rand(0, 9) . ')' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . '"';
            $contato->email = 'contato' . $i . '@contato.com.br';
            $contato->motivo_contato =  rand(1, 3);
            $contato->mensagem = 'Mensagem ' . $i . ' enviada automaticamente';
            $contato->save();
        }
    }
}