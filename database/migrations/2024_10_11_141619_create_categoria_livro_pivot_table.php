<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categoria_livro_pivot', function (Blueprint $table) {
            $table->uuid('livro_id');
            $table->uuid('categoria_id');

            // Definindo as chaves estrangeiras
            $table->foreign('livro_id')->references('id')->on('livros')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            // Chave primária composta para garantir que não haja duplicação
            $table->primary(['livro_id', 'categoria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_livro_pivot');
    }
};
