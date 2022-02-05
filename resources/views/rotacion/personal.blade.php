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
    form{
      display: inline-block;
    }  
  </style>
@stop

@section('content_header')
  <div class="card">
    <section class="card-header">
      <div class="row">
        <div class="col d-flex align-items-center">
          <h3 class="m-0">Horario</h3>
        </div>
        <div class="col d-flex justify-content-end align-content-center">
          <a class="btn bg-teal" data-toggle="modal" data-target="#modalDetallePost">Nuevo Registro</a>
        </div>
      </div>
    </section>

    <section class="card-body">
      <x-adminlte-datatable id="tablaHorarios" :heads="$heads" theme="light" striped hoverable beautify bordered compressed with-buttons>
        @foreach($data as $row)
            <tr>
              <td>{!! $count++ !!}</td>
              <td>{!! $row->empleado !!}</td>
              <td>{!! $row->dias !!}</td>
              <td>{!! $row->horaE !!}</td>
              <td>{!! $row->horaS !!}</td>
              <td>
                <span class="badge rounded-pill" style="background-color:{!! $row->color !!}">
                  {!! $row->puesto !!}
                </span>
              </td>
              <td>
                <nobr>
                  <form class="formEliminar" action="{{route('deleteRotacion', $row->codigo)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                  </form>
                  <a class="btn btn-xs btn-default bg-teal text-white mx-1 shadow btnDetalles" title="Detalles" data-toggle="modal" data-target="#modalDetallePut"  id="{!! $count !!}">
                    <i class="fa fa-lg fa-fw fa-eye" id="{!! $count !!}"></i>
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
  <!-- Formulario para agregar un registro -->
  <form action="{{route('nuevaRotacion')}}" method="post">
    @csrf
    
    <x-adminlte-modal id="modalDetallePost" title="Nuevo Registro" size="lg" theme="teal"
      icon="fas fa-plus-square" v-centered static-backdrop scrollable>  
      <section>
        {{-- Fila 1 --}}
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="empleado" name="codigo" required>
                <option selected disabled>Seleccione</option>
                @foreach($data2 as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombres." ".$row->apellidos !!}</option>
                @endforeach
              </select>
              <label form="empleado">Empleado</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="dias" name="dias" required>
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
              <input type="time" class="form-control" id="horaE" name="entrada" required>
              <label for="horaE">Entrada</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="time" class="form-control" id="horaS" name="salida" required>
              <label for="horaS">Salida</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="jornada" name="jornada" required>
                <option selected disabled>Seleccione</option>
                <option value="M">Matutina</option>
                <option value="V">Vespertina</option>
                <option value="N">Nocturna</option>
              </select>
              <label form="jornada">Jornada</label>
            </div>
          </div>
          <div class="col-sm-1">
            <div class="form-floating mb-3">
              <input type="color" class="form-control form-control-color" id="color" name="color" placeholder="" required>
              <label for="color">Color</label>
            </div>
          </div>
        </div>

        {{-- Fila 3 --}}
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <textarea class="form-control" placeholder="Opcional" id="descripcion" name="descripcion"></textarea>
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

  <!-- Formulario para actulizar un registro -->
  <form action="{{route('updateRotacion', 1)}}" method="post">
    @csrf
    @method('put')
    
    <x-adminlte-modal id="modalDetallePut" title="Actualizar Registro" size="lg" theme="primary"
    icon="fas fa-plus-square" v-centered static-backdrop scrollable>  
      <section class="inputsUpdate">
        {{-- Fila 1 --}}
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select inputUpdate" id="empleado" name="empleado" disabled required>
                </option>
                @foreach($data2 as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombres." ".$row->apellidos !!}</option>
                @endforeach
              </select>
              <label form="empleado">Empleado</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select inputUpdate" id="dias" name="dias" disabled required>
                <option selected></option>
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
              <input type="time" class="form-control inputUpdate" id="horaE" name="entrada" disabled required>
              <label for="horaE">Entrada</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="time" class="form-control inputUpdate" id="horaS" name="salida" disabled required>
              <label for="horaS">Salida</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select inputUpdate" id="jornada" name="jornada" disabled required>
                <option selected disabled>Seleccione</option>
                <option value="M">Matutina</option>
                <option value="V">Vespertina</option>
                <option value="N">Nocturna</option>
              </select>
              <label form="jornada">Jornada</label>
            </div>
          </div>
          <div class="col-sm-1">
            <div class="form-floating mb-3">
              <input type="color" class="form-control form-control-color inputUpdate" id="color" name="color" placeholder="" disabled required>
              <label for="color">Color</label>
            </div>
          </div>
        </div>

        {{-- Fila 3 --}}
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <textarea class="form-control inputUpdate" placeholder="Opcional" id="descripcion" name="descripcion" disabled></textarea>
              <label for="descripcion">Descripción</label>
            </div>
          </div>
        </div>

        <div class="row g-2 d-none">
          <div class="col-md">
            <input type="number" class="inputUpdate" id="rotacion" name="rotacion">
          </div>
        </div>

      </section>
      <x-slot name="footerSlot">
        <a class="btn btn-warning" id="btnEditar">Editar</a>
        <x-adminlte-button class="d-none btnHidden" type="submit"  theme="success" label="Actualizar"/>
        <x-adminlte-button class="d-none btnHidden" theme="danger" label="Cancelar" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-modal>
  </form>
@stop
  
@section('js')
  <script >
    $( document ).ready(function() {

      // variables
      let buttons = document.querySelectorAll(".btnDetalles");
      let inputsU = document.querySelectorAll(".inputUpdate");
      let btnEditar = document.getElementById('btnEditar');
      let btnHiden = document.querySelectorAll(".btnHidden");
      let data = {!! json_encode($data) !!};
      console.log(data);
      //
      buttons.forEach(el => {
        el.addEventListener("click", e => {
          let id = e.target.getAttribute('id');
          id = id -2;          

          inputsU[0].options[0].innerHTML = data[id].empleado;
          inputsU[0].options[0].value = data[id].codEmpleado;
          inputsU[1].options[0].innerHTML = data[id].dias;
          inputsU[1].options[0].value = data[id].dias;
          inputsU[2].value = data[id].horaE;
          inputsU[3].value = data[id].horaS;
          inputsU[4].options[0].innerHTML = data[id].jornada;
          inputsU[4].options[0].value = data[id].jornada;
          inputsU[5].value = data[id].color;
          inputsU[6].value = data[id].descripcion;
          inputsU[7].value = data[id].codigo;
          console.log(inputsU);
        });
      });

      // 
      btnEditar.addEventListener('click', () =>{
        btnEditar.classList.add('d-none');
        btnHiden.forEach(el => el.classList.remove('d-none'));
        inputsU.forEach(el => el.disabled = false);
      });

      //
      $('#modalDetallePut').on('hidden.bs.modal', function (e) {
        inputsU.forEach(el => {
          if(!el.disabled) el.disabled = true;
          btnEditar.classList.remove('d-none');
          btnHiden.forEach(el => el.classList.add('d-none'));
        });
      });

      //
      @if(session('eliminar') == 'ok')
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: '¡Eliminado!',
          text: 'El registro se elimino con éxito.',
          showConfirmButton: false,
          timer: 2000
        });
      @endif

      //
      $('.formEliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
          title: '¿Estás seguro/a?',
          text: "¡No podrás revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '¡Si, eliminar!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        });
      });
      
    });
  </script>
@stop
