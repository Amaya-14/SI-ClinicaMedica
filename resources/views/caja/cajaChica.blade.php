@extends('adminlte::page')

@section('title', 'Caja')

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
@stop

@section('content_header')
  <div class="card">
    <section class="card-header">
      <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="CajaChica-tab" data-toggle="tab" href="#CajaChica" role="tab" aria-controls="CajaChica" aria-selected="true">Caja Chica</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="materiales-tab" data-toggle="tab" href="#materiales" role="tab" aria-controls="materiales" aria-selected="false">Cajas Registradoras</a>
        </li>
      </ul>
    </section>

    <section class="card-body">
      <div class="tab-content">
        {{-- Panel 1 --}}
        <div class="tab-pane active" id="CajaChica" role="tabpanel" aria-labelledby="CajaChica-tab">
          {{-- Filtro --}}
          <div class="row g-2 mb-3">
            <div class="col-auto">
              <form action="">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon2">Filtrar</span>
                  <input type="date" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                  <button class="btn btn-outline-primary" type="submit" id="button-addon2">Enviar</button>
                </div>
              </form>
            </div>
            <div class="col-md">
              <div class="d-flex justify-content-end">
                <a class="btn bg-teal" data-toggle="modal" data-target="#modalApertura">Nueva Apertura</a>
              </div>
            </div>
          </div>
          {{-- Información --}}
          <form action="">
            <div class="row g-3">
              <h3 class="mb-0 mt-1">Información</h3>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="caja" placeholder="" required>
                  <label for="caja">Caja</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="user" placeholder="" required>
                  <label for="user">Usuario</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="date" class="form-control" id="fechaRegistro" placeholder="" required>
                  <label for="fechaRegistro">Fecha de Registro</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="cantidadInicial" placeholder="" required>
                  <label for="cantidadInicial">Cantidad Inicial</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="cantidadCierre" placeholder="" required>
                  <label for="cantidadCierre">Cantidad Cierre</label>
                </div>
              </div>
            </div>
          </form>
          <hr class="mt-0 mb-4">
          {{-- Tabla --}}
          <div class="row g-2">
            <div class="col-md">
              <x-adminlte-datatable id="tablaMovimientos" :heads="$heads1" theme="light" striped hoverable beautify bordered compressed>
                @foreach($data1 as $row)
                  <tr>
                    <td>{!! $row->cod_movimiento !!}</td>
                    <td>{!! $row->fec_movimiento !!}</td>
                    <td>{!! $row->tip_movimiento !!}</td>
                    <td>{!! $row->can_movimiento !!}</td>
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
            </div>
          </div>
        </div>

        {{-- Panel 2 --}}
        <div class="tab-pane" id="materiales" role="tabpanel" aria-labelledby="materiales-tab">
          <div class="row g-2">
            <div class="col-md-3">
              <h3 class="mb-0">Nueva Caja</h3>
              <form action="">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="nombreCajaR" placeholder="xxxx" required>
                  <label for="nombreCajaR">Nombre Caja</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="descripcionCajaR" placeholder="xxxx">
                  <label for="descripcionCajaR">Descripción Caja</label>
                </div>
                <button class="btn btn-primary text-white">Guardar</button>
              </form>
              
            </div>
            <div class="col-md">
              <x-adminlte-datatable id="tablaMateriales" :heads="$heads2" theme="light" striped hoverable beautify bordered compressed>
                @foreach($data2 as $row)
                  <tr>
                    @foreach ($row as $cell)
                      <td>{!! $cell !!}</td>
                    @endforeach
                    <td>
                      <nobr>
                        <a class="btn btn-xs btn-primary text-white mx-1 shadow" title="Editar">
                          <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                        </a>
                      </nobr>
                    </td>
                  </tr>
                @endforeach
              </x-adminlte-datatable>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop

@section('content')
  <form action="">
    {{-- Custom --}}
    <x-adminlte-modal id="modalApertura" title="Nueva Apertura" size="sm" theme="teal"
    icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="usuarioR" placeholder="usuario" required>
              <label for="usuarioR">Usuario</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="cajaR" required>
                <option selected disabled value="">Seleccione</option>
                <option value="1">Caja 1</option>
                <option value="2">Caja 2</option>
              </select>
              <label for="cajaR">Caja</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="fehcaAperturaR" placeholder="" required>
              <label for="fehcaAperturaR">Fecha Apertura</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="cantidadIniciarlR" placeholder="000" required>
              <label for="cantidadIniciarlR">Cantidad Inicial</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="fehcaCierreR" placeholder="" required>
              <label for="fehcaCierreR">Fecha Cierre</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="cantidadFinalR" placeholder="000" required>
              <label for="cantidadFinalR">Cantidad Final</label>
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
