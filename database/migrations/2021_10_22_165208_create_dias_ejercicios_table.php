<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiasEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_ejercicios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('dia_rutina_id')->constrained('dias_rutinas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('ejercicio_id')->constrained('ejercicios')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('dias_ejercicios');
    }
}
