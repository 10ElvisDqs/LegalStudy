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
        Schema::create('casos', function (Blueprint $table) {

            $table->id();
            $table->string('titulo',100);
            $table->string('descripcion',500);
            $table->date('fecha_apertura');
            $table->string('estado');
            $table->unsignedBigInteger('id_tipo');
            $table->unsignedBigInteger('id_cliente');
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('id_cliente')->references('id')->on('clients');
            $table->foreign('id_tipo')->references('id')->on('tipos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        
        Schema::dropIfExists('casos');
    }
};
