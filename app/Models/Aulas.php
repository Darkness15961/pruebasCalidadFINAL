<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'tipo',
        'aforo',
        'estado',
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'aula_id');
    }
}
