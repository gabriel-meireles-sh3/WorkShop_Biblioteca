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
        Schema::create('livros', function (Blueprint $table) {
            $table->uuid('id')->primary();;

            $table->string('titulo');
            $table->integer('anoPublicacao');
            $table->string('descricao');

            $table->uuid('comentario_id')->nullable();
            $table->foreign('comentario_id')->references('id')->on('comentarios');


            $table->timestamp('criado_em');
            $table->timestamp('atualizado_em');
            $table->softDeletes('excluido_em');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
