<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Objeto Fornecedor
        /*$fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contato@fornecedor100.com.br';
        $fornecedor->save();

        // Metodo da Classe FornecedorModel
        for ($i = 2; $i < 30; $i++) {
            Fornecedor::create([
                'nome' => 'Fornecedor' . $i * 100,
                'site' => 'fornecedor' . $i * 100 . '.com.br',
                'uf' => 'RS',
                'email' => 'contato@fornecedor' . $i * 100 . '.com.br'
            ]);
        }

        // Metodo da Classe DB
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor1000',
            'site' => 'fornecedor1000.com.br',
            'uf' => 'RS',
            'email' => 'contato@fornecedor1000.com.br'
        ]);*/
        Fornecedor::factory()->count(100)->create();
    }
}