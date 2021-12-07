@extends('adminlte::page')

@section('title', 'Citas')

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  <style>
      .btn-color{
        background-color: #f8f9fa;
        border-color: #ddd;
        color: #444;
      }
  </style>
@stop

@section('content_header')
  <div class="card">
      <section class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <h3 class="m-0">Registro de Citas</h3>
          </div>
        </div>
      </section>

      <section class="card-body">
        <x-adminlte-datatable id="tablaCitas" :heads="$heads" theme="light" striped hoverable beautify bordered compressed with-buttons>
          @foreach($data as $row)
              <tr>
                <td>{!! $row->cod_cita !!}</td>
                <td>{!! $row->cod_paciente !!}</td>
                <td>{!! $row->cod_doctor !!}</td>
                <td>{!! $row->fec_cita !!}</td>
                <td>{!! $row->hora_inicio !!}</td>
                <td>{!! $row->hora_final !!}</td>
                <td>{!! $row->tip_estado !!}</td>
                <td>{!! $row->tip_cita !!}</td>
                <td>
                  <nobr>
                    <a class="btn btn-xs btn-primary text-white mx-1 shadow" title="Editar">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>
                    <a class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles" data-toggle="modal" data-target="#modalCita">
                      <i class="fa fa-lg fa-fw fa-eye"></i>
                    </a>
                  </nobr>
                </td>
              </tr>
          @endforeach
      </x-adminlte-datatable>
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
                <option value="1">Paciente 1</option>
                <option value="2">Paciente 2</option>
                <option value="3">Paciente 3</option>
                <option value="4">Paciente 4</option>
              </select>
              <label form="paciente">Paciente</label>
          </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="medico" required>
                <option selected disabled value="">Seleccione</option>
                <option value="1">Doctor 1</option>
                <option value="2">Doctor 2</option>
                <option value="3">Doctor 3</option>
                <option value="4">Doctor 4</option>
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
@stop
