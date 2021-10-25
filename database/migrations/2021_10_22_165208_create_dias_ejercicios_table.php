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
            $table->string('series')->nullable();
            $table->string('repeticiones')->nullable();
            $table->string('peso')->nullable();
            $table->string('rpe')->nullable();
            $table->string('cadencia')->nullable();
            $table->string('descanso')->nullable();
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
