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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('horario_id');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->unsignedBigInteger('aula_id');
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('aula_id')->references('aula_id')->on('aulas')->onDelete('cascade');
            $table->foreign('curso_id')->references('curso_id')->on('cursos')->onDelete('cascade');
            $table->foreign('docente_id')->references('docente_id')->on('docentes')->onDelete('cascade');
            $table->string('estado', 10)->default('activo');
            $table->string('tipo', 10)->default('teoria');
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
        Schema::dropIfExists('horarios');
    }
};
