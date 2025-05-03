@extends('adminlte::page')
@section('title', 'Dashboard')

@section('css')

@stop

@section('content_header')
<h1>Horarios</h1>
@stop

@section('content')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
{{-- Botón de creación con componente AdminLTE --}}
<x-adminlte-button label="Crear horario" theme="primary" data-toggle="modal" data-target="#crearModal" class="mb-3" />
<x-adminlte-card title="Calendario" theme="light" icon="fas fa-calendar">
    <div id='calendar'></div>
</x-adminlte-card>
<div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="crearModalLabel">Crear Horario</h4>
                <button onclick="CloseModal()" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                    aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form onsubmit="onSubmit(event)" method="POST">
                    <input type="hidden" id="horario_id" name="horario_id" value="">
                    <div class="mb-3">
                        <label for="curso_id" class="form-label">Curso</label>
                        <select class="form-control" id="curso_id" name="curso_id" required>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->curso_id }}">{{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="docente_id" class="form-label">Docente</label>
                        <select class="form-control" id="docente_id" name="docente_id" required>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->docente_id }}">{{ $docente->nombres }} {{ $docente->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="aula_id" class="form-label">Aula</label>
                        <select class="form-control" id="aula_id" name="aula_id" required>
                            @foreach($aulas as $aula)
                                <option value="{{ $aula->aula_id }}">{{ $aula->codigo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" />
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                        <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" />
                    </div>
                    <!-- <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required />
                    </div> -->
                    <div class="modal-footer">
                        <button type="button" onclick="CloseModal()" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    let calendar; // 👈 Hacemos visible la variable en todo el script

    const getHorarios = async () => {
        const data = await fetch('/get_horarios', {
            method: 'GET'
        });

        const horarios = await data.json();

        horarios.forEach(horario => {
            calendar.addEvent({
                ...horario,
                title: horario.nombre,
                start: horario.fecha_inicio,
                end: horario.fecha_fin,
                color: horario.color ?? '#0056b3',
            });
        });
    };

    document.addEventListener('DOMContentLoaded', async function () {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            timeZone: 'UTC',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            views: {
                listWeek: {
                    buttonText: 'Pendientes'
                }
            },
            navLinks: true,
            editable: false,
            selectable: true,
            events: [],
            eventClick: function (info) {
                // Puedes acceder a los datos del evento con info.event
                const evento = info.event;

                let horario = evento?._def?.extendedProps

                editHorario(horario)

                // Si quieres evitar que el navegador siga el link (si tuviera), usa:
                info.jsEvent.preventDefault();
            }
        });

        calendar.render();

        await getHorarios();
    });

    const onSubmit = async (e) => {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        formData.append('_token', '{{ csrf_token() }}');

        const horarioId = document.getElementById('horario_id').value;
        const isEditing = horarioId !== '';

        const url = isEditing ? `/horarios/${horarioId}` : '/horarios';
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

    function formatDateForInput(dateString) {
        const date = new Date(dateString);

        // Asegura formato YYYY-MM-DDTHH:MM
        const yyyy = date.getFullYear();
        const mm = String(date.getMonth() + 1).padStart(2, '0');
        const dd = String(date.getDate()).padStart(2, '0');
        const hh = String(date.getHours()).padStart(2, '0');
        const min = String(date.getMinutes()).padStart(2, '0');

        return `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    }

    function editHorario(horario) {

        console.log(horario)

        document.getElementById('horario_id').value = (horario.horario_id ?? 0).toString();
        document.getElementById('curso_id').value = horario.curso_id;
        document.getElementById('docente_id').value = horario.docente_id;
        document.getElementById('aula_id').value = horario.aula_id;
        document.getElementById('fecha_inicio').value = formatDateForInput(horario.fecha_inicio);
        document.getElementById('fecha_fin').value = formatDateForInput(horario.fecha_fin);


        $('#crearModal').modal('show');
    }

    function CloseModal() {
        $('#crearModal').modal('hide');
    }
</script>
@stop