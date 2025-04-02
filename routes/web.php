<?php

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

// Distribución académica
Route::get('/distribucion-academica', function () {
    return view('admin.distribrucionAcademica');
});

// Creación de horarios
Route::get('/horarios', function () {
    return view('admin.horarios');
});


// Publicación de horarios
Route::get('/publicar-horarios', function () {
    return view('admin.prublicacionHorarios');
});

// Actualización de carpetas académicas
Route::get('/carpetas-academicas', function () {
    return view('admin.carpetasAcademicas');
});

