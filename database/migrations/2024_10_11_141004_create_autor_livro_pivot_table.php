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
        Schema::create('autor_livro_pivot', function (Blueprint $table) {
            $table->uuid('livro_id');
            $table->uuid('autor_id');

            // Defining foreign keys
            $table->foreign('livro_id')->references('id')->on('livros')->onDelete('cascade');
            $table->foreign('autor_id')->references('id')->on('autores')->onDelete('cascade');

            // Composite primary key to prevent duplication
            $table->primary(['livro_id', 'autor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autor_livro_pivot');
    }
};
