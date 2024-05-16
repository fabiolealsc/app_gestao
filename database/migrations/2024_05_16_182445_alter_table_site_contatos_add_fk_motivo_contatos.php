<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // cria a coluna motivo_contatos_id que será usada como referencia
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->unsignedBigInteger('motivo_contatos_id');
        });

        // coloca os dados da coluna motivo_contato para motivo_contato_id
        DB::statement('update site_contatos set motivo_contatos_id = motivo_contato');

        // cria a chave estrangeira site_contatos_motivo_contatos_id_foreign e exclui a coluna motivo_contato
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos');
            $table->dropColumn('motivo_contato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // deleta a chave estrangeira site_contatos_motivo_contatos_id_foreign e inclui a coluna motivo_contato
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->integer('motivo_contato');
            $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
        });


        // coloca os dados da coluna  motivo_contato_id para motivo_contato
        DB::statement('update site_contatos set motivo_contato = motivo_contatos_id');

        // deleta a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropColumn('motivo_contatos_id');
        });
    }
};