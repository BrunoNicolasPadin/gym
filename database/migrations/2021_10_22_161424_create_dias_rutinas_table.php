<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiasRutinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_rutinas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('rutina_id')->constrained('rutinas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre');
            $table->string('slug')->index();
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
        Schema::dropIfExists('dias_rutinas');
    }
}
