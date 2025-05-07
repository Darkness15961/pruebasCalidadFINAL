<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class AulaTest extends TestCase
{
  /**
   * A basic unit test example.
   *
   * @return void
   */

   public function test_codigo_requerido()
   {
       $data = ['tipo' => 'teoria', 'aforo' => 25];
       $rules = ['codigo' => 'required'];

       $validator = Validator::make($data, $rules);

       $this->assertTrue($validator->fails());
       $this->assertArrayHasKey('codigo', $validator->errors()->toArray());
   }

   public function test_tipo_debe_ser_valido()
   {
       $data = ['codigo' => 'A105', 'tipo' => 'virtual', 'aforo' => 20];
       $rules = ['tipo' => 'in:teoria,laboratorio,mixto'];

       $validator = Validator::make($data, $rules);

       $this->assertTrue($validator->fails());
       $this->assertArrayHasKey('tipo', $validator->errors()->toArray());
   }

   public function test_aforo_predeterminado()
   {
       $data = ['codigo' => 'A106', 'tipo' => 'teoria'];
       $rules = ['aforo' => 'nullable|integer'];

       $validator = Validator::make($data, $rules);

       $this->assertFalse($validator->fails());
   }
}
