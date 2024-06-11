<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {


        Schema::table('produtos', function (Blueprint $table) {

            $fornecedor_id = DB::table('fornecedores')->insertGetId(
                [
                    'nome' => 'Fornecedor Padrão',
                    'site' => 'fornecedorpadrao.com.br',
                    'uf' => 'RS',
                    'email' => 'contato@fornecedorpadrao.com.br'
                ]
            );

            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign('produtos_fornecedor_id_foreing');
            $table->dropColumn('fornecedor_id');
        });
    }
};