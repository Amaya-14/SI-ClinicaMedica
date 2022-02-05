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

      .content-img{
        border: 2px dashed #e9e9e9;
        padding: 1rem;
      }

      .item-img{
        width:100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        object-position: center;
      }

      .add-img{
        cursor: pointer;
        text-decoration: underline;
        color: blue;
        margin: 0;
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
              <a class="nav-link active" id="pacientes-tab" data-toggle="tab" href="#pacientes" role="tab" aria-controls="pacientes" aria-selected="true">Pacientes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="empleados-tab" data-toggle="tab" href="#empleados" role="tab" aria-controls="empleados" aria-selected="false">Empleados</a>
            </li>
          </ul>
        </div>
        <div class="col-md d-flex justify-content-end">
          <a class="btn bg-teal" data-toggle="modal" data-target="#modalRegistro" id="btn-nuevo-registro">Nuevo Registro</a>
        </div>
      </div>
    </section>

    <section class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="pacientes" role="tabpanel" aria-labelledby="pacientes-tab">
          <x-adminlte-datatable id="tablaPacientes" :heads="$heads" theme="light" striped hoverable beautify bordered compressed with-buttons>
            @if (!empty($responses['pacientes']->object()))
              @foreach($responses['pacientes']->object() as $row)
                <tr>
                  <td>{!! $row->codigo !!}</td>
                  <td>{!! "0".substr($row->identidad,0,3)."-".substr($row->identidad,3,4)."-".substr($row->identidad,7) !!}</td>
                  <td>{!! $row->nombres." ".$row->apellidos !!}</td>
                  <td>{!! $row->nacionalidad !!}</td>
                  <td>{!! $row->edad !!}</td>
                  <td>{!! $row->fecha_nacimiento !!}</td>
                  <td>{!! $row->sexo !!}</td>
                  <td>
                    <nobr>
                      <form class="d-inline-block formEliminar" action="{{route('deletePersona', ['pacientes',$row->codigo])}}" method="post">
                        {!! csrf_field() !!}
                        @method('delete')
                        <button class="btn btn-xs btn-danger text-white mx-1 shadow btnEliminar" title="Eliminar">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                      </form>
                      <a href="{{route('detallePersona', ['paciente',$row->codigo, $row->codigoP])}}" class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                      </a>
                    </nobr>
                  </td>
                </tr>
              @endforeach
            @endif
          </x-adminlte-datatable>
        </div>
        <div class="tab-pane" id="empleados" role="tabpanel" aria-labelledby="empleados-tab">
          <x-adminlte-datatable id="tablaEmpleados" :heads="$heads" theme="light" striped hoverable beautify bordered compressed with-buttons>
            @if(!empty($responses['empleados']->object()))
              @foreach($responses['empleados']->object() as $row)
                <tr>
                  <td>{!! $row->codigo !!}</td>
                  <td>{!! "0".substr($row->identidad,0,3)."-".substr($row->identidad,3,4)."-".substr($row->identidad,7) !!}</td>
                  <td>{!! $row->nombres." ".$row->apellidos !!}</td>
                  <td>{!! $row->nacionalidad !!}</td>
                  <td>{!! $row->edad !!}</td>
                  <td>{!! $row->fecha_nacimiento !!}</td>
                  <td>{!! $row->sexo !!}</td>
                  <td>
                    <nobr>
                      <form class="d-inline-block formEliminar" action="{{route('deletePersona', ['empleados',$row->codigo])}}" method="post">
                        {!! csrf_field() !!}
                        @method('delete')
                        <button class="btn btn-xs btn-danger text-white mx-1 shadow btnEliminar" title="Eliminar">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                      </form>
                      <a href="{{route('detallePersona', ['empleado',$row->codigo])}}" class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
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
    </section>
  </div>
@stop

@section('content')
    <form action="{{route('nuevaPersona')}}" method="post" id="nuevoRegistro">
      @csrf
      {{-- Custom --}}
      <x-adminlte-modal id="modalRegistro" title="Nuevo Registro" size="lg" theme="teal"
      icon="fas fa-bell" v-centered static-backdrop scrollable>  
      <section>
        {{-- Fila 0 --}}
        <div class="row g-2 hidden d-none">
          <div class="col-md mb-3 d-flex flex-column justify-content-around align-items-center content-img">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="item-img" alt="persona">
            <p class="add-img">Agregar foto (opcional)</p>
            <div class="d-none">
              <div class="form-floating">
                <input class="input-file form-control" type="file" accept="image/png, image/gif, image/jpeg" name="foto" id="foto">
                <label for="foto">Foto</label>
              </div>
            </div>
          </div>
        </div>
          {{-- Fila 1 --}}
          <div class="row g-2">
            <div class="col-sm-2">
              <div class="form-floating mb-3">
                <select class="form-select" id="tipRegistro" name="tipRegistro" required>
                  <option value="P" selected>Paciente</option>
                  <option value="E">Empleado</option>
                </select>
                <label for="tipRegistro">Tipo de Registo</label>
              </div>
            </div>
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
                <input type="email" class="form-control" id="email" name="correo" placeholder="example@example.com" >
                <label for="email">Correo Electrónico (Opcional)</label>
              </div>
            </div>
            <div class="col-md hidden d-none">
              <div class="form-floating mb-3">
                <select class="form-select" id="cargo" name="cargo">
                  <option selected disabled value="">Seleccione</option>
                  @foreach($responses['cargos']->object() as $row)
                    <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                  @endforeach
                </select>
                <label for="cargo">Puesto</label>
              </div>
            </div>
            <div class="col-md hidden d-none">
              <div class="form-floating mb-3">
                <input type="date" class="form-control" id="fechaContratacion" name="fechaContratacion" placeholder="">
                <label for="fechaContratacion">Fecha de Contratación</label>
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
    let toggle = document.getElementById('tipRegistro');
    let hidden = document.querySelectorAll('.hidden');
    let addImg = document.querySelector(".add-img");
    let inputFile = document.querySelector(".input-file");
    let formRegistro = document.getElementById('nuevoRegistro');
    let data1 = {!! json_encode($responses['pacientes']->object()) !!};
    let data2 = {!! json_encode($responses['empleados']->object()) !!};
    let imgReview = document.querySelector(".item-img");
    let fomrsEliminar = document.querySelectorAll(".formEliminar");
    
    inputFile.addEventListener('input', e => {
      imgReview.src = e.target.value;
    })
    
    // Habilitar - deshabilitar inputs al cambiar el tipo de registro
    toggle.addEventListener('change', event =>{
      if(event.target.value == 'E'){
        hidden.forEach(el =>{
          el.classList.remove('d-none');
        });
        formRegistro[19].required = true;
        formRegistro[20].required = true;
      }else{
        hidden.forEach(el =>{
          el.classList.add('d-none')
        });
        formRegistro[19].required = false;
        formRegistro[20].required = false;

        console.log(formRegistro[2].value);
      }
    });

    // Dar evento al input file cuando se da click en el texto
    addImg.addEventListener('click', e => { 
      inputFile.click();
    });

    formRegistro.addEventListener('submit', e =>{
      e.preventDefault();
      let ok = true;
      
      for (let el of data1){
        if(formRegistro[4].value == '0'+el.identidad){
          ok = false;
          break;
        } 
      } 

      if (!ok) {
        for (let el of data2){
          if(formRegistro[4].value == '0'+el.identidad){
            ok = false;
            break;
          } 
        }
      }
      
      if (ok){
        formRegistro.submit();
      }else{
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'warning',
          iconColor: '#FFD700',
          title: '¡La identidad que trata de ingresar ya existes!',
          showConfirmButton: false,
          timer: 7000,  
        });
      } 
    });

    //
    fomrsEliminar.forEach(el => {
        el.addEventListener('submit', e =>{
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
              el.submit();
            }
          });
        });
      })
    
  </script>

    <!-- <script>
      let formCreate = document.getElementById("nuevaPersona");
      let fomrsEliminar = document.querySelectorAll(".formEliminar");
      let data = {!! json_encode($responses['pacientes']->object()) !!};
      let addImg = document.querySelector(".add-img");
      let inputFile = document.querySelector(".input-file");

      addImg.addEventListener('click', e => { 
        inputFile.click();
      });



      formCreate.addEventListener('submit', e =>{
        e.preventDefault();
        let ok = true;
        for (let el of data){
          if(formCreate[2].value == '0'+el.identidad){
            ok = false;
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'warning',
              iconColor: '#FFD700',
              title: '¡La identidad que trata de ingresar ya existes!',
              showConfirmButton: false,
              timer: 7000,  
            });
          }
        }
        if (ok) formCreate.submit();
      });
      
      fomrsEliminar.forEach(el => {
        el.addEventListener('submit', e =>{
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
              el.submit();
            }
          });
        });
      })
    </script> -->

    @if (session('create') == 'ok')
      <script>
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: '¡El Paciente se creo con éxito!',
          iconColor: '#00a135',  
          showConfirmButton: false,
          timer: 3200,  
        })
      </script>
    @endif

    @if(session('delete') == 'ok')
      <script>
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'El registro se elimino con éxito.',
          iconColor: '#00a135',  
          showConfirmButton: false,
          timer: 3200,  
        })
      </script>
    @endif

    @if(session('delete') == 'error' || session('create') == 'error')
      <script>
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'danger',
          title: '¡Ups! Ha ocurrido un error inesperado',
          iconColor: '#FF0000',  
          showConfirmButton: false,
          timer: 3200,  
        })
      </script>
    @endif
@stop
