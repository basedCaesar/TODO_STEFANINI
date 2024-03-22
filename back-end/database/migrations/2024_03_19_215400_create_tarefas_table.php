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
        /*
            Cria a tabela com os campos necessários para lista de tarefas
        */
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',50);
            $table->text('descricao')->nullable();
            $table->enum('status', ['não iniciado', 'em andamento', 'concluído'])->default('não iniciado');
            $table->timestamps();
        });
    }

    /**
     * Reverte a migration
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
