<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjerciciosEntrenamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicios_entrenamientos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('dia_ejercicio_id')->constrained('dias_ejercicios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('entrenamiento_id')->constrained('entrenamientos')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejercicios_entrenamientos');
    }
}
