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
        Schema::create('asignacion_casos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_caso');
            $table->unsignedBigInteger('id_abogado');
            $table->date('fecha_asignacion');
            $table->date('fecha_desasignacion')->nullable();
            $table->string('rol_en_caso')->nullable();//Un campo para especificar el rol que desempeña el abogado en el caso (por ejemplo, abogado principal, asistente, consultor).
            $table->enum('estado', ['activo', 'inactivo', 'completado'])->default('activo');//estado actual de la asignación (activo, inactivo, completado).
            $table->decimal('horas_trabajadas', 8, 2)->nullable()->default(0.0);
            $table->timestamps();

            $table->foreign('id_caso')->references('id')->on('casos')->onDelete('cascade');
            $table->foreign('id_abogado')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_casos');
    }
};
