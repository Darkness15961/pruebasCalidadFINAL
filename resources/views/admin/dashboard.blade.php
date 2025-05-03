@extends('adminlte::page')
@section('title', 'Dashboard')

@section('css')

@stop

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <h1 class="mb-4">Bienvenido al Dashboard de Gestión Académica</h1>

    <div class="row">

        <!-- Card para Aulas -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Aulas</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('aulas.index') }}" class="btn btn-success btn-lg">Gestionar Aulas</a>
                </div>
            </div>
        </div>

        <!-- Card para Cursos -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Cursos</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('cursos.index') }}" class="btn btn-warning btn-lg">Gestionar Cursos</a>
                </div>
            </div>
        </div>
        <!-- Card para Docentes -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Docentes</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('docentes.index') }}" class="btn btn-info btn-lg">Gestionar Docentes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">


        <!-- Card para Elaborar Horarios -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Elaborar Horarios</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('horarios.index') }}" class="btn btn-dark btn-lg">Elaborar Horarios</a>
                </div>
            </div>
        </div>

        <!-- Card para Publicar Horarios -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Publicar Horarios</h4>
                </div>
                <div class="card-body text-center">
                    <a href="" class="btn btn-danger btn-lg">Publicar Horarios</a>
                </div>
            </div>
        </div>
        <!-- Card para Actualización de Carpetas Académicas -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Actualización de Carpetas Académicas</h4>
                </div>
                <div class="card-body text-center">
                    <a href="" class="btn btn-secondary btn-lg">Actualizar Carpetas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script> console.log('Hi!'); </script>
@stop