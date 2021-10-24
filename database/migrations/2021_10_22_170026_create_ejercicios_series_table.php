<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjerciciosSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicios_series', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('dia_ejercicio_id')->constrained('dias_ejercicios')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('numero');
            $table->integer('repeticiones')->nullable();
            $table->float('peso', 5, 2)->nullable();
            $table->float('rpe', 3, 1)->nullable();
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
        Schema::dropIfExists('ejercicios_series');
    }
}
