@extends('adminlte::page')

@section('title', 'Distribución')

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">

  <!-- Bootstrap -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    .btn-color{
        background-color: #f8f9fa;
        border-color: #ddd;
        color: #444;
      }
  </style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@stop

@section('content_header')
  <div class="card">
    <section class="card-header">
      <div class="row">
        <div class="col d-flex align-items-center">
          <h3 class="m-0">Horario</h3>
        </div>
        <div class="col d-flex justify-content-end align-content-center">
          <a class="btn bg-teal" data-toggle="modal" data-target="#modalDetalle">Nuevo Registro</a>
        </div>
      </div>
    </section>

    <section class="card-body">
      <x-adminlte-datatable id="tablaHorarios" :heads="$heads" theme="light" striped hoverable beautify bordered compressed with-buttons>
        @foreach($data as $row)
            <tr>
              <td>{!! $row->codigo !!}</td>
              <td>{!! $row->empleado !!}</td>
              <td>{!! $row->dias !!}</td>
              <td>{!! $row->horaE !!}</td>
              <td>{!! $row->horaS !!}</td>
              <td>
                <span class="badge rounded-pill" style="background-color:{!! $row->color !!} ">
                  {!! $row->puesto !!}
                </span>
              </td>
              <td>
                <nobr>
                  <a class="btn btn-xs btn-primary text-white mx-1 shadow" title="Editar">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                  <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                  </a>
                  <a class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
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
  <form action="">
    {{-- Custom --}}
    <x-adminlte-modal id="modalDetalle" title="Nuevo Registro" size="lg" theme="teal"
      icon="fas fa-plus-square" v-centered static-backdrop scrollable>  
      <section>
          {{-- Fila 1 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                <select class="form-select" id="empleado" required>
                  <option selected disabled value="">Seleccione</option>
                  @foreach($data2 as $row)
                    <option value="{!! $row->codigo !!}">{!! $row->nombres." ".$row->apellidos !!}</option>
                  @endforeach
                </select>
                <label form="empleado">Empleado</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <select class="form-select" id="dias" required>
                  <option selected disabled value="">Seleccione</option>
                  <option value="L">Lunes</option>
                  <option value="Ma">Martes</option>
                  <option value="Mi">Miercoles</option>
                  <option value="J">Jueves</option>
                  <option value="V">Viernes</option>
                </select>
                <label form="dias">Días</label>
              </div>
            </div>
          </div>
          {{-- Fila 2 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="time" class="form-control" id="horaE" required>
                <label for="horaE">Entrada</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="time" class="form-control" id="horaS" required>
                <label for="horaS">Salida</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <select class="form-select" id="jornada" required>
                  <option selected disabled value="">Seleccione</option>
                  <option value="M">Matutina</option>
                  <option value="V">Vespertina</option>
                  <option value="N">Nocturna</option>
                </select>
                <label form="jornada">Jornada</label>
              </div>
            </div>
            <div class="col-sm-1">
              <div class="form-floating mb-3">
                <input type="color" class="form-control form-control-color" id="color" placeholder="" required>
                <label for="color">Color</label>
              </div>
            </div>
          </div>

          {{-- Fila 3 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Opcional" id="descripcion"></textarea>
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
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>



<script>
  $('.multipleS').selectpicker();
</script>
@stop
