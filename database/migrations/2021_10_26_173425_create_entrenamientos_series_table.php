<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrenamientosSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrenamientos_series', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('ejercicio_entrenamiento_id')->index()->constrained('ejercicios_entrenamientos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('repeticiones');
            $table->float('peso', 5, 2);
            $table->float('rpe', 2, 1)->nullable();
            $table->float('rm', 5, 2)->nullable();
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
        Schema::dropIfExists('entrenamientos_series');
    }
}
