@extends('adminlte::page')

@section('title', 'Pacientes')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
      .modal-content{
        width: 950px; 
      }

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
          <div class="col d-flex align-items-center">
            <h3 class="m-0">Pacientes</h3>
          </div>
          <div class="col d-flex justify-content-end align-content-center">
            <a class="btn bg-teal" data-toggle="modal" data-target="#modalPacientes">Nuevo Paciente</a>
          </div>
        </div>
      </section>

      <section class="card-body">
        <x-adminlte-datatable id="tablaPacientes" :heads="$heads" theme="light" striped hoverable beautify bordered compressed with-buttons>
          @foreach($data as $row)
              <tr>
                  <td>{!! $row->codigo !!}</td>
                  <td>{!! $row->identidad !!}</td>
                  <td>{!! $row->nombres." ".$row->apellidos !!}</td>
                  <td>{!! $row->nacionalidad !!}</td>
                  <td>{!! $row->edad !!}</td>
                  <td>{!! $row->fecha_nacimiento !!}</td>
                  <td>{!! $row->sexo !!}</td>
                  <td>{!! $row->estado_civil !!}</td>
                  <td>
                    <nobr>
                      <a class="btn btn-xs btn-primary text-white mx-1 shadow" title="Editar">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                      </a>
                      <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                      </a>
                      <a href="{{route('detalle', $row->codigo)}}" class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
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
    {{-- Modal - Nuevo Paciente --}}
    <form action="{{route('nuevaPersona', 'pacientes')}}" method="post">
      @csrf
      {{-- Custom --}}
      <x-adminlte-modal id="modalPacientes" title="Registrar Paciente" size="lg" theme="teal"
      icon="fas fa-bell" v-centered static-backdrop scrollable>  
      <section>
          {{-- Fila 1 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="identidad" name="identidad" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" placeholder="0000000000000" required>
                <label for="identidad">Número de Identidad</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="xxxx" required>
                <label for="nacionalidad">Nacionalidad</label>
              </div>
            </div>
          </div>

          {{-- Fila 2 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastname" name="apellidos" placeholder="xxxx xxxx" required>
                <label for="lastname">Apellidos</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="nombres" placeholder="xxxx xxxx" required>
                <label for="name">Nombres</label>
              </div>
            </div>
          </div>

          {{-- Fila 3 --}}
          <div class="row g-2">
            <div class="col-sm-2">
              <div class="form-floating mb-3">
                <select class="form-select" id="sexo" name="sexo" required>
                  <option selected disabled value="">Seleccione</option>
                  <option value="H">Hombre</option>
                  <option value="M">Mujer</option>
                </select>
                <label for="sexo">Sexo</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="" required>
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="edad" name="edad" min="1" onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;" placeholder="000" required>
                <label for="edad">Edad</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <select class="form-select" id="estadoCivil" name="estadoCivil" required>
                  <option selected disabled value="">Seleccione</option>
                  <option value="S">Soltero</option>
                  <option value="C">Casado</option>
                  <option value="D">Divorciado</option>
                  <option value="V">Viudo/a</option>
                </select>
                <label for="estadoCivil">Estado Civil</label>
              </div>
            </div>
          </div>

          {{-- Fila 4 --}}
          <div class="row g-2">
            <div class="col-sm-2">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="area" name="numArea" placeholder="000" value="504" required>
                <label for="area">Número de Area</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="telefono" name="numTelefono" placeholder="00000000" required>
                <label for="telefono">Celular/Télefono</label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-floating mb-3">
                <select class="form-select" id="tipoTelefono" name="tipoTelefono" required>
                  <option selected disabled value="">Seleccione</option>
                  <option value="P">Personal</option>
                  <option value="C">Casa</option>
                  <option value="F">Familiar</option>
                  <option value="O">Otro</option>
                </select>
                <label for="tipoTelefono">Tipo de Télefono</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="desTelefono" name="desTelefono" placeholder="Descripcion">
                <label for="desTelefono">Descripción de Télefono (Opcional)</label>
              </div>
            </div>
          </div>

          {{-- Fila 5 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="xxxx" required>
                <label for="direccion">Dirección</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="referencia" name="desDireccion" placeholder="xxxx">
                <label for="referencia">Referencia (Opcional)</label>
              </div>
            </div>
          </div>

          {{-- Fila 6 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating">
                <input type="email" class="form-control" id="email" name="correo" placeholder="example@example.com" required>
                <label for="email">Correo Electrónico</label>
              </div>
            </div>
            <div class="col-md"></div>
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
    <script> console.log('Hi!'); </script>
@stop
