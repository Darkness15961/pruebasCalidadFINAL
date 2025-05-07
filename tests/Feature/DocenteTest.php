<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Docente;
use Tests\TestCase;

class DocenteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_crear_docente_con_datos_validos()
    {
        $docente = Docente::create([
            'nombres' => 'María',
            'apellidos' => 'Lopez',
            'profesion' => 'Ingeniera',
        ]);

        $this->assertDatabaseHas('docentes', [
            'nombres' => 'María',
            'estado' => 'activo' // por defecto
        ]);
    }

    public function test_estado_por_defecto_es_activo()
    {
        $docente = Docente::create([
            'nombres' => 'Carlos',
            'apellidos' => 'Ramírez',
            'profesion' => 'Matemático',
            'estado' => 'activo' // se ignora porque el valor por defecto es 'activo'
        ]);

        $this->assertEquals('activo', $docente->estado);
    }

    public function test_docente_factory_funciona()
    {
        $docente = Docente::factory()->create();

        $this->assertNotNull($docente->docente_id);
        $this->assertEquals('activo', $docente->estado);
    }
}
