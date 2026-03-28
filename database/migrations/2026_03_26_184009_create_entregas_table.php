<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarea_id')->constrained('tareas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('archivo');
            $table->dateTime('fecha_entrega');
            $table->timestamps();

            $table->unique(['tarea_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};