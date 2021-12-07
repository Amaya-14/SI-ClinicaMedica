@extends('adminlte::page')

@section('title', 'Citas')

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">

  <!-- Bootstrap -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  <!-- FullCalendar -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.css">
@stop

@section('content_header')
    <div class="card">
      <section class="card-header">
        <div class="row">
          <div class="col d-flex align-items-center">
            <h3 class="m-0">Agenda</h3>
          </div>
        </div>
      </section>

      <section class="card-body">
        <div id="calendarCitas"></div>
      </section>
    </div>
@stop

@section('content')
    <form action="#" method="POST">
      <x-adminlte-modal id="modalCita" title="Nueva Cita" size="lg" theme="teal" icon="fas fa-bell" v-centered static-backdrop scrollable>
        <section>
          {{-- Fila 1 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                  <select class="form-select" id="paciente" required>
                    <option selected disabled value="">Seleccione</option>
                    @foreach($data2 as $row)
                      <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                    @endforeach
                  </select>
                  <label form="paciente">Paciente</label>
              </div>
            </div>
            <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select" id="medico" required>
                    <option selected disabled value="">Seleccione</option>
                    @foreach($data3 as $row)
                      <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                    @endforeach
                  </select>
                  <label form="medico">Doctor/a</label>
                </div>
            </div>
          </div>
          {{-- Fila 2 --}}
          <div class="row g-2">
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="date" class="form-control" id="fehca" placeholder="01/01/2021" required>
                      <label for="fehca">Fecha Cita</label>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="time" class="form-control" id="hora_inicio" placeholder="00:00" required>
                      <label for="hora_inicio">Hora Inicio</label>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="time" class="form-control" id="hora_final" placeholder="00:00" required>
                      <label for="hora_final">Hora Final</label>
                  </div>
              </div>
          </div>
          {{-- Fila 3 --}}
          <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select" id="estado" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="L">Libre</option>
                    <option value="T">Tentativo</option>
                    <option value="O">Ocupado</option>
                    <option value="A">Ausente</option>
                  </select>
                  <label for="estado">Estado</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select" id="Tcita" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="N">Normal</option>
                    <option value="Q">Quirurgico</option>
                  </select>
                  <label for="Tcita">Tipo de Cita</label>
                </div>
              </div>
          </div>
          {{-- Fila 4 --}}
          <div class="row g-2">
              <div class="col-md">
                  <div class="form-floating">
                      <textarea class="form-control" placeholder="Descripción" id="descripcion"></textarea>
                      <label for="descripcion">Descripción</label>
                  </div>
              </div>
          </div>
        </section>
        <x-slot name="footerSlot">
          <x-adminlte-button type="submit"  theme="success" label="Guardar"/>
          <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
        </x-slot>
      </x-adminlte-modal>
    </form>
@stop

@section('js')
    <!-- FullCalendar -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/locales-all.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendarCitas');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            dateClick: function(info) {
                $("#modalCita").modal("show");
            }
        });
        calendar.render();
    });
  </script>
@stop
