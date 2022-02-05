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

    .formEliminar{
      display: inline-block;
    }
  </style>
@stop

@section('content_header')
  <div class="card">
    <section class="card-header">
      <div class="row">
        <div class="col-md">
          <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active btnNav btnNavCH" id="CajaChica-tab" data-toggle="tab" href="#CajaChica" role="tab" aria-controls="CajaChica" aria-selected="true">Caja Chica</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btnNav btnNavC" id="CajasRegistradoras-tab" data-toggle="tab" href="#materiales" role="tab" aria-controls="materiales" aria-selected="false">Cajas Registradoras</a>
            </li>
          </ul>
        </div>
        <div class="col-md d-flex justify-content-end">
          <a class="btn btn-secondary mr-2 btnRegistro" data-toggle="modal" data-target="#modalApertura" id="btn-nuevo-registro">Nueva Apertura</a>
          <a class="btn btn-secondary btnRegistro" data-toggle="modal" data-target="#modalFactura" id="btn-nuevo-registro">Nuevo Ingreso/Gasto</a>
        </div>
      </div>
    </section>

    <section class="card-body">
      <div class="tab-content">
        {{-- Panel 1 --}}
        <div class="tab-pane active" id="CajaChica" role="tabpanel" aria-labelledby="CajaChica-tab">
          {{-- Filtro --}}
          <div class="row g-2 mb-3">
            <div class="col-auto">
              <form action="{{route('movimientos')}}" method="get">
                @csrf
                <div class="input-group mb-3">
                  <span class="input-group-text">Filtrar</span>
                  <input type="date" class="form-control" placeholder="" name="fechaBusqueda">
                  <button class="btn btn-outline-primary" type="submit">Buscar</button>
                </div>
              </form>
            </div>
            @if (!empty($data1))
              <div class="col-md-3">
                <div class="input-group mb-3">
                  <span class="input-group-text" for="itemsAperturas">Aperturas</span>
                  <select class="form-select" id="itemsAperturas">
                    <option value="none" selected>Seleccione...</option>
                    @foreach ($data1 as $row)
                      <option value="{!! $count++ !!}">{!! $row->caja !!}</option>
                    @endforeach
                  </select>
                  <a class="btn btn-outline-primary" id="btnAplicar">Aplicar</a>
                </div>
              </div>
            @endif
          </div>
          @if (!empty($data1))
            {{-- Información --}}
            <form action="">
              <div class="row g-2 d-flex">
                <div class="col-md">
                  <h3 class="mb-0 mt-1">Información Apertura/Cierre</h3>
                </div>
                <div class="col-md d-flex justify-content-end align-items-center">
                  <a class="btn text-black btnEditar d-none" title="Editar" id="btnEditar">
                    <i class="fa fa-lg fa-fw fa-edit " ></i>
                  </a>
                  <button type="submit" class="btn text-black btnHidden d-none" title="Guardar" id="guardar1">
                    <i class="fa fa-lg fa-fw fa-save"></i>
                  </button>
                  <a class="btn text-black btnHidden d-none" title="Cancelar" id="btnCancelar">
                    <i class="fa fa-lg fa-fw fa-times"></i>
                  </a>
                </div>
              </div>
              <hr class="mt-0 mb-3">
              <div class="row g-3">
                <div class="col-md">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control inputUpdate updateAC" id="caja" placeholder="" disabled required>
                    <label for="caja">Caja</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control inputUpdate updateAC" id="user" placeholder="" disabled required>
                    <label for="user">Usuario</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-4">
                    <input type="date" class="form-control inputUpdate updateAC" id="fechaRegistro" placeholder="" disabled required>
                    <label for="fechaRegistro">Fecha de Registro</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-4">
                    <input type="number" class="form-control inputUpdate updateAC" id="cantidadInicial" placeholder="" disabled required>
                    <label for="cantidadInicial">Cantidad Inicial</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-4">
                    <input type="number" class="form-control inputUpdate updateAC" id="cantidadCierre" placeholder="" disabled required>
                    <label for="cantidadCierre">Cantidad Cierre</label>
                  </div>
                </div>
              </div>
            </form>
            <div class="row g-2 d-flex">
              <div class="col-md">
                <h3 class="mb-0 mt-1">Movimientos</h3>
              </div>
            </div>
            <hr class="mt-0 mb-3">
            {{-- Tabla --}}
            <div class="row g-2">
              <div class="col-md">
                <x-adminlte-datatable id="tablaMovimientos" :heads="$heads1" theme="light" striped hoverable beautify bordered compressed>
                  @if (!empty($data2))
                    @foreach($data2 as $row)
                      <tr>
                        <td>{!! $count2++ !!}</td>
                        <td>{!! $row->codigoF !!}</td>
                        <td>{!! $row->movimiento !!}</td>
                        <td>{!! $row->cantidad !!}</td>
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
                  @endif
                </x-adminlte-datatable>
              </div>
            </div>
          @endif
        </div>

        {{-- Panel 2 --}}
        <div class="tab-pane" id="materiales" role="tabpanel" aria-labelledby="materiales-tab">
          <div class="row g-2">
            <div class="col-md">
              <x-adminlte-datatable id="tablaMateriales" :heads="$heads2" theme="light" striped hoverable beautify bordered compressed>
                @if(!empty($data3))
                  @foreach($data3 as $row)
                    <tr>
                      <td>{!! $count3++ !!}</td>
                      <td>{!! $row->nombre !!}</td>
                      <td>{!! $row->descripcion !!}</td>
                      <td>
                        <nobr>
                          <form class="formEliminar" action="{{route('borrarRegistro', $row->codigo)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                          </form>
                          <a class="btn btn-xs btn-primary text-white mx-1 shadow" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                          </a>
                        </nobr>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </x-adminlte-datatable>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop

@section('content')
  <!-- Formulario nueva apertura de caja -->
  <form action="{{route('nuevoRegistro', 'apertura')}}" method="post">
    @csrf
    <x-adminlte-modal id="modalApertura" title="Nueva Apertura" size="sm" theme="teal" icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="usuarioR" name="usuario" placeholder="usuario" required>
              <label for="usuarioR">Usuario</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="cajaR" name="caja" required>
                <option selected disabled value="">Seleccione</option>
                @foreach ($data3 as $row )
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="cajaR">Caja</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="fehcaApertura" name="fecha" placeholder="" required>
              <label for="fehcaAperturaR">Fecha Apertura</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="cantidadIniciarlR" name="cantidad" placeholder="000" required>
              <label for="cantidadIniciarlR">Cantidad Inicial</label>
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

  <!-- Formulario nuevo gasto/ingreso -->
  <form action="{{route('nuevoRegistro', 'apertura')}}" method="post">
    @csrf
    <x-adminlte-modal id="modalFactura" title="Nuevo Registro" size="lg" theme="teal" icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="tipoRegistro" name="tipoRegistro" required>
                <option selected disabled value="">Seleccione</option>
                <option value="I">Ingreso</option>
                <option value="G">Gasto</option>
              </select>
              <label for="tipoRegistro">Tipo de Registro</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" required>
              <label for="usuario">Usuario</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="usuario" name="usuario" placeholder="usuario" required>
              <label for="usuario">Usuario</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="cajaR" name="caja" required>
                <option selected disabled value="">Seleccione</option>
                @foreach ($data3 as $row )
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="cajaR">Caja</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="fehcaApertura" name="fecha" placeholder="" required>
              <label for="fehcaAperturaR">Fecha Apertura</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="cantidadIniciarlR" name="cantidad" placeholder="000" required>
              <label for="cantidadIniciarlR">Cantidad Inicial</label>
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

  <!-- Formulario registrar nueva caja -->
  <form action="{{route('nuevoRegistro', 'cajas')}}" method="post">
    @csrf
    <x-adminlte-modal id="modalCajas" title="Nueva Caja" size="sm" theme="teal" icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombreC" name="nombre" placeholder="Nombre" required>
              <label for="usuarioR">Nombre</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="descripcionC" name="descripcion" placeholder="Descripción">
              <label for="usuarioR">Descripción (Opcional)</label>
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

  <form action="{{route('updateRegistro', 'caja')}}" method="post">
    @csrf
    @method('put')
    <x-adminlte-modal id="modalCajasU" title="Actualizar Caja" size="sm" theme="teal" icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombreC" name="nombre" placeholder="Nombre" required>
              <label for="usuarioR">Nombre</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="descripcionC" name="descripcion" placeholder="Descripción">
              <label for="usuarioR">Descripción (Opcional)</label>
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
  <script>
    // Variables
    let inputsU = document.querySelectorAll('.inputUpdate');
    let btnEditar = document.getElementById('btnEditar');
    let btnCancelar = document.getElementById('btnCancelar');
    let btnHiden = document.querySelectorAll(".btnHidden");
    let btnsNav = document.querySelectorAll(".btnNav");
    let btnsRegistro = document.querySelectorAll('.btnRegistro');
    let btnAplicar = document.getElementById('btnAplicar');
    let inputAplicar = document.getElementById('itemsAperturas');
    let data1 = {!! json_encode($data1) !!};
    let fechaA = document.getElementById('fehcaApertura');
    let f = new Date();

    fechaA.value = `${f.getFullYear()}-${f.getMonth()}-${f.getDate()}`;
    fechaA.min = `${f.getFullYear()}-${f.getMonth()}-${f.getDate()}`;
    fechaA.max = `${f.getFullYear()}-${f.getMonth()}-${f.getDate()}`;

    @if(!empty($data1))
      btnEditar.classList.remove('d-none');
      btnEditar.addEventListener('click', () =>{
        btnEditar.classList.add('d-none');
        btnHiden.forEach(el => el.classList.remove('d-none'));
        inputsU.forEach(el => el.disabled = false);
      });

      btnCancelar.addEventListener('click', () =>{
        btnEditar.classList.remove('d-none');
        btnHiden.forEach(el => el.classList.add('d-none'));
        inputsU.forEach(el => el.disabled = true);
        addData1();
      });

      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Datos encontrados',
        background: '#00a135',
        color: '#fff',
        iconColor: '#fff', 
        showConfirmButton: false,
        timer: 3200,  
      })
    @endif

    @if(empty($data1))
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡No hay datos en la fecha seleccionada!',
      })
    @endif
    
    btnsNav.forEach(el => {
      el.addEventListener("click", e => {
        if (el.classList.contains('btnNavCH')) {
          if(btnsRegistro[0].dataset.target != "#modalApertura") btnsRegistro[0].dataset.target = "#modalApertura";
          if (btnsRegistro[0].innerHTML !== 'Nueva Apertura') btnsRegistro[0].innerHTML = 'Nueva Apertura';
          if (btnsRegistro[1].classList.contains('d-none')) btnsRegistro[1].classList.remove('d-none');
        }

        if(el.classList.contains('btnNavC')) {
          if(btnsRegistro[0].dataset.target != "#modalCajas") btnsRegistro[0].dataset.target = "#modalCajas";
          if (btnsRegistro[0].innerHTML !== 'Nueva Caja') btnsRegistro[0].innerHTML = 'Nueva Caja';
          if (!btnsRegistro[1].classList.contains('d-none')) btnsRegistro[1].classList.add('d-none');
        }
      });
    });

    //
    btnAplicar.addEventListener('click', function (){
      let id = inputAplicar.value;
      if (id != 'none'){
        addData1(id);
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Campos actualizados',
          background: '#00a135',
          color: '#fff',
          iconColor: '#fff', 
          showConfirmButton: false,
          timer: 3200,  
        })
        inputAplicar.options[0].selected = true;
      }else{
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '¡No ha seleccionado ningún elemento a mostrar!',
        })
      }
    })

    //
      @if(session('eliminar') == 'ok')
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: '¡Eliminado!',
          text: 'El registro se elimino con éxito.',
          background: '#00a135',
          color: '#fff',
          iconColor: '#fff', 
          showConfirmButton: false,
          timer: 3200
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



    function addData1(id){
      inputsU[0].value = data1[id].caja;
      inputsU[1].value = data1[id].usuario;
      inputsU[2].value = data1[id].fechaApertura;
      inputsU[3].value = data1[id].cantidadInicial;
      inputsU[4].value = data1[id].cantidadFinal;
    }
  </script>
@stop
