<?php

use App\Http\Controllers\AulasController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\HorarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function(){
    return redirect()->route('login');
});

Route::get('/aulas', [AulasController::class,'index'])->name('aulas.index');
Route::post('/aulas', [AulasController::class,'store'])->name('aulas.store');
Route::put('/aulas/{id}', [AulasController::class,'update'])->name('aulas.update');
Route::delete('/aulas/{id}', [AulasController::class,'destroy'])->name('aulas.destroy');

Route::get('/docentes', [DocenteController::class,'index'])->name('docentes.index');
Route::post('/docentes', [DocenteController::class,'store'])->name('docentes.store');
Route::get('/docentes/{id}', [DocenteController::class,'destroy'])->name('docentes.destroy');

Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
Route::put('/cursos/{id}', [CursoController::class, 'update'])->name('cursos.update');
Route::delete('/cursos/{id}', [CursoController::class, 'destroy'])->name('cursos.destroy');

// Distribución académica
Route::get('/distribucion-academica', function () {
    return view('admin.distribrucionAcademica');
});

// Creación de horarios
Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
Route::post('/horarios', [HorarioController::class, 'store'])->name('horarios.store');
Route::put('/horarios/{id}', [HorarioController::class, 'update'])->name('horarios.update');
Route::get('/get_horarios', [HorarioController::class, 'get_horarios']);


// Publicación de horarios
Route::get('/publicar-horarios', function () {
    return view('admin.prublicacionHorarios');
});

// Actualización de carpetas académicas
Route::get('/carpetas-academicas', function () {
    return view('admin.carpetasAcademicas');
});

