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
        Schema::create('contenidos', function (Blueprint $table) {
            $table->id('contenido_id');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('archivo')->nullable();
            $table->string('estado', 10)->default('activo');
            $table->unsignedBigInteger('carpeta_academica_id');
            $table->foreign('carpeta_academica_id')->references('carpeta_academica_id')->on('carpetas_academicas')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('contenidos');
    }
};
