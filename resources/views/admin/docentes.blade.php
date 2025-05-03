@extends('adminlte::page')

@section('title', 'Docentes')

@section('content_header')
    <h1>Docentes</h1>
@stop

@section('content')
    {{-- Botón de creación con componente AdminLTE --}}
    <x-adminlte-button label="Crear Docente" theme="primary" data-toggle="modal" data-target="#crearModal" class="mb-3"/>

    {{-- Card con tabla de docentes --}}
    <x-adminlte-card title="Lista de Docentes" theme="light" icon="fas fa-users">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Profesión</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($docentes as $docente)
                    <tr>
                        <td>{{ $docente->nombres }}</td>
                        <td>{{ $docente->apellidos }}</td>
                        <td>{{ $docente->profesion }}</td>
                        <td>
                            <span class="badge {{ $docente->estado == 'Activo' ? 'badge-success' : 'badge-secondary' }}">
                                {{ $docente->estado }}
                            </span>
                        </td>
                        <td>
                            <x-adminlte-button label="Editar" theme="primary" size="sm" />
                            <x-adminlte-button label="Eliminar" theme="danger" size="sm" onclick="eliminardocente({{ $docente->docente_id }})"/>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay docentes registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $docentes->links() }}
        </div>
    </x-adminlte-card>
@stop

@section('js')
    <script>
        function eliminardocente(id) {
            if(confirm('¿Estás seguro de eliminar este docente?')) {
                // lógica para eliminar
                console.log("Eliminar docente con ID: " + id);
            }
        }
    </script>
@stop
