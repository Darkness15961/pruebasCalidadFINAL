@extends('adminlte::page')
@section('title', 'Dashboard')

@section('css')

@stop

@section('content_header')
<h1>Aulas</h1>
@stop

@section('content')
<p>Bienvenido a la sección de Aulas.</p>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearModal">
  Crear Aula
</button>
<div class="card mt-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Aforo</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aulas as $aula)
            <tr>
                <th scope="row">{{ $aula->codigo }}</th>
                <td>{{ $aula->tipo }}</td>
                <td>{{ $aula->aforo }}</td>
                <td>{{ $aula->estado }}</td>
                <td>
                    <button type="button" class="btn btn-primary">Editar</button>
                    <button type="button" id="btnEliminar" onclick="eliminarAula({{ $aula->aula_id }})" class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="crearModalLabel">Crear Aula</h4>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('aulas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="codigo" class="form-label">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Aula</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="teoria">Teoria</option>
                    <option value="laboratorio">Laboratorio</option>
                    <option value="mixto">Mixto</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="aforo" class="form-label">Aforo</label>
                <input type="number" class="form-control" id="aforo" name="aforo" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado">
                    <option value="disponible">Disponible</option>
                    <option value="no disponible">No disponible</option>
                </select>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@section('js')
<script> 
function eliminarAula(id){
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
                url: '/aulas/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Eliminado!',

                        'El aula ha sido eliminada correctamente.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
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