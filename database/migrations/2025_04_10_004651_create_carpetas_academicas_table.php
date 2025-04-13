<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpetas_academicas', function (Blueprint $table) {
            $table->id('carpeta_academica_id');
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('resultados')->nullable();
            $table->string('estado', 10)->default('activo');
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('curso_id')->on('cursos')->onDelete('cascade');
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
        Schema::dropIfExists('carpetas_academicas');
    }
};
