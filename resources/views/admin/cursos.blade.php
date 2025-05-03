@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
<h1>Cursos</h1>
@stop

@section('content')
{{-- Botón de creación con componente AdminLTE --}}
<x-adminlte-button label="Crear Curso" theme="primary" data-toggle="modal" data-target="#crearModal" class="mb-3" />

{{-- Card con tabla de docentes --}}
<x-adminlte-card title="Lista de Cursos" theme="light" icon="fas fa-book">
    <table class="table table-hover table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Horas T.</th>
                <th>Horas P.</th>
                <th>Creditos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cursos as $curso)
                <tr>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->horas_teoricas }}</td>
                    <td>{{ $curso->horas_practicas }}</td>
                    <td>{{ $curso->creditos }}</td>
                    <td>
                        <x-adminlte-button label="Editar" theme="primary" size="sm" onclick='editCurso({{ $curso }})' />
                        <x-adminlte-button label="Eliminar" theme="danger" size="sm"
                            onclick="eliminarCurso({{ $curso->curso_id }})" />
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
        {{ $cursos->links() }}
    </div>
</x-adminlte-card>

<div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="crearModalLabel">Crear Curso</h4>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                    aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form onsubmit="onSubmit(event)" method="POST">
                    <input type="hidden" id="curso_id" name="curso_id" value="">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="horas_p" class="form-label">Horas practicas</label>
                        <input type="number" class="form-control" id="horas_p" name="horas_p" required>
                    </div>
                    <div class="mb-3">
                        <label for="horas_t" class="form-label">Horas teoricas</label>
                        <input type="number" class="form-control" id="horas_t" name="horas_t" required>
                    </div>
                    <div class="mb-3">
                        <label for="creditos" class="form-label">Creditos</label>
                        <input type="number" class="form-control" id="creditos" name="creditos" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js"
    integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@section('js')
<script>

    const onSubmit = async (e) => {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        formData.append('_token', '{{ csrf_token() }}');

        const cursoId = document.getElementById('curso_id').value;
        const isEditing = cursoId !== '';

        const url = isEditing ? `/cursos/${cursoId}` : '/cursos';
        const method = isEditing ? 'PUT' : 'POST';

        if (isEditing) formData.append('_method', 'PUT');

        try {
            const response = await fetch(url, {
                method: 'POST', // Laravel requiere POST + _method=PUT para PUT
                body: formData,
            });

            if (!response.ok) throw new Error('Error en el servidor');

            const data = await response.json();
            location.reload();
        } catch (error) {
            console.error('Error al enviar el formulario:', error);
        }
    };


    function editCurso(curso) {
        document.getElementById('curso_id').value = curso.curso_id;
        document.getElementById('nombre').value = curso.nombre;
        document.getElementById('horas_p').value = curso.horas_practicas;
        document.getElementById('horas_t').value = curso.horas_teoricas;
        document.getElementById('creditos').value = curso.creditos;
        document.getElementById('descripcion').value = curso.descripcion || '';

        const modal = new bootstrap.Modal(document.getElementById('crearModal'));
        modal.show();
    }

    function eliminarCurso(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/cursos/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        Swal.fire(
                            'Eliminado!',
                            'El curso ha sido eliminada correctamente.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Error!',
                            'Ocurrió un error al eliminar el aula.',
                            'error'
                        );
                    }
                });
            }
        });
    };
</script>
@stop