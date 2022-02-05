@extends('adminlte::page')

@section('title', 'Empleado')

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
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
  <!--  -->
  <x-adminlte-card theme="lightblue" theme-mode="outline">
    @foreach ($data as $row )
      <form action="{{route('updatePersona', 'empleado')}}" method="post">
        {!! csrf_field() !!}
        @method('put')

        {{-- Fila 0 --}}
        <div class="row g-2">
          <div class="col-md mb-3 d-flex flex-column justify-content-around align-items-center content-img">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="item-img" alt="persona">
            <p class="add-img d-none">Cambiar foto</p>
            <div class="d-none">
              <div class="form-floating">
                <input class="input-file form-control" type="file" accept="image/png, image/gif, image/jpeg" name="foto" id="foto">
                <label for="foto">Foto</label>
              </div>
            </div>
          </div>
        </div>

        {{-- Fila 1 --}}
        <section class="row g-2 m-auto">
          <div class="d-flex justify-content-between">
            <h4 class="mt-2 mr-0 mb-0 ml-2">Datos Generales</h4>
            <div class="d-flex justify-content-end ">
              <a class="btn text-black btnEditar editar1" >
                <i class="fa fa-lg fa-fw fa-edit editar1" title="Editar" id="editar1"></i>
              </a>
              <button type="submit" class="btn text-black hidden hidden1 d-none" title="Guardar" id="guardar1">
                <i class="fa fa-lg fa-fw fa-save"></i>
              </button>
              <a class="btn text-black hidden btnCerrar cerrar1 d-none" title="Cancelar" id="cancelar1">
                <i class="fa fa-lg fa-fw fa-times"></i>
              </a>
            </div>  
          </div>
        </section>
  
        <div>
          <hr class="mt-0 mb-1 mr-0 ml-0">
        </div>
        
        {{-- Fila 2 --}}
        <section class="row g-2 m-auto">
          <div class="col-sm-3">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputGeneral" id="identidad" name="identidad" value="{!! "0".$row->identidad !!}" placeholder="" required disabled>
              <label for="identidad">Número de Identidad</label>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputGeneral" id="nacionalidad" name="nacionalidad" value="{!! $row->nacionalidad !!}" required disabled>
              <label for="nacionalidad">Nacionalidad</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputGeneral" id="lastname" name="apellidos" value="{!! $row->apellidos !!}" placeholder="" required disabled>
              <label for="lastname">Apellidos</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputGeneral" id="name" name="nombres" value="{!! $row->nombres !!}" required disabled>
              <label for="name">Nombres</label>
            </div>
          </div>
        </section>
  
        {{-- Fila 3 --}}
        <section class="row g-2 m-auto">
          <div class="col-sm-2">
            <div class="form-floating mb-2">
              <select class="form-select inputGeneral" id="sexo" name="sexo" required disabled>
                <option selected disabled value="{!! substr($row->sexo,0,1) !!}">{!! $row->sexo !!}</option>
                <option value="H">Hombre</option>
                <option value="M">Mujer</option>
              </select>
              <label for="sexo">Sexo</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="date" class="form-control inputGeneral" id="fechaNacimiento" name="fechaNacimiento" value="{!! $row->fecha !!}" required disabled>
              <label for="fechaNacimiento">Fecha de Nacimiento</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="number" class="form-control inputGeneral" id="edad" name="edad" value="{!! $row->edad !!}" required disabled>
              <label for="edad">Edad</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating mb-2">
              <select class="form-select inputGeneral" id="estadoCivil" name="estadoCivil" required disabled>
                <option selected disabled value="{!! substr($row->estado_civil,0,1) !!}">{!! $row->estado_civil !!}</option>
                <option value="S">Soltero</option>
                <option value="C">Casado</option>
                <option value="D">Divorciado</option>
                <option value="V">Viudo/a</option>
              </select>
              <label for="estadoCivil">Estado Civil</label>
            </div>
          </div>
          <div class="row g-2 m-auto">
            <div class="col-md d-none">
              <div class="form-floating mb-2">
                <input type="number" class="form-control inputGeneral" id="codigo" name="codigo" value="{!! $row->codigoP !!}" required disabled>
                <label for="codigo">Codigo</label>
              </div>
            </div>
            <div class="col-md d-none">
              <div class="form-floating mb-2">
                <input type="number" class="form-control inputGeneral" id="persona" name="persona" value="{!! $row->codigo !!}" required disabled>
                <label for="persona">Persona</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-2">
                <select class="form-select inputGeneral" id="cargo" name="cargo" required disabled>
                  <option selected disabled value="">Seleccione</option>
                  @foreach($data5 as $fila)
                    <option value="{!! $fila->codigo !!}">{!! $fila->nombre !!}</option>
                  @endforeach
                </select>
                <label for="cargo">Puesto</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-2">
                <input type="date" class="form-control inputGeneral" id="fechaContratacion" name="fechaContratacion" value="{!! $row->fechaContratacion !!}" placeholder="" required disabled>
                <label for="fechaContratacion">Fecha de Contratación</label>
              </div>
            </div>
          </div>
        </section>
      </form>  
    @endforeach
  </x-adminlte-card>

  <!--  -->
  <x-adminlte-card title="Teléfonos" theme="lightblue" theme-mode="outline" icon="fas fa-lg fa-phone-alt" collapsible="collap">
    @if (!empty($data2))
      <section class="row g-2 m-auto">
        <x-adminlte-datatable id="tabalaTelefonos" :heads="$heads" theme="light" striped hoverable beautify bordered compressed>
          @foreach($data2 as $row2)
            <tr>
              <td>{!! $row2->area !!}</td>
              <td>{!! $row2->telefono !!}</td>
              <td>{!! $row2->tipo !!}</td>
              <td>{!! $row2->descripcion !!}</td>
              <td>
                <nobr>
                  <form class="d-inline-block formDelete" action="{{route('deleteRegistros', ['telefonos', $row2->codigo, $row->codigo])}}" method="post">
                    {!! csrf_field() !!}
                    @method('delete')
                    <button class="btn btn-xs btn-danger text-white mx-1 shadow btnEliminar" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                  </form>
                  <a class="btn btn-xs btn-primary text-white mx-1 shadow btnEditar editar2" title="Editar" id="{!! $row2->codigo !!}">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                </nobr>
              </td>
            </tr>
          @endforeach
        </x-adminlte-datatable>
      </section>
    @endif
  </x-adminlte-card>

  <!--  -->
  <x-adminlte-card title="Direcciones" theme="lightblue" theme-mode="outline" icon="fas fa-lg fa-map-marked-alt" collapsible="collap">
    @if (!empty($data3))
      <section class="row g-2 m-auto">
        <x-adminlte-datatable id="tablaDirecciones" :heads="$heads2" theme="light" striped hoverable beautify bordered compressed>
          @foreach($data3 as $row3)
            <tr>
              <td>{!! $row3->direccion !!}</td>
              <td>{!! $row3->descripcion !!}</td>
              <td>
                <nobr>
                  <form class="d-inline-block formDelete" action="{{route('deleteRegistros', ['direcciones', $row3->codigo, $row->codigo])}}" method="post">
                    {!! csrf_field() !!}
                    @method('delete')
                    <button class="btn btn-xs btn-danger text-white mx-1 shadow btnEliminar" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                  </form>
                  <a class="btn btn-xs btn-primary text-white mx-1 shadow btnEditar editar3" title="Editar" id="{!! $row3->codigo !!}">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                </nobr>
              </td>
            </tr>
          @endforeach
        </x-adminlte-datatable>
      </section>
    @endif
  </x-adminlte-card>

  <!--  -->
  <x-adminlte-card title="Correos" theme="lightblue" theme-mode="outline" icon="fas fa-lg fa-envelope" collapsible="collap">
    @if (!empty($data4))
      <section class="row g-2 m-auto">
        <x-adminlte-datatable id="tablaCorreos" :heads="$heads3" theme="light" striped hoverable beautify bordered compressed>
          @foreach($data4 as $row4)
            <tr>
              <td>{!! $row4->correo !!}</td>
              <td>
                <nobr>
                  <form class="d-inline-block formDelete" action="{{route('deleteRegistros', ['correos', $row4->codigo, $row->codigo])}}" method="post">
                    {!! csrf_field() !!}
                    @method('delete')
                    <button class="btn btn-xs btn-danger text-white mx-1 shadow btnEliminar" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                  </form>
                  <a class="btn btn-xs btn-primary text-white mx-1 shadow btnEditar editar4" title="Editar" id="{!! $row4->codigo !!}">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                </nobr>
              </td>
            </tr>
          @endforeach
        </x-adminlte-datatable>
      </section>
    @endif
  </x-adminlte-card>
@stop

@section('content')
  <!--  -->
  <form action="{{route('updateRegistros', 'telefonos')}}" method="post">
    {!! csrf_field() !!}
    @method('put')
    {{-- Custom --}}
    <x-adminlte-modal id="modalTelefonos" title="Actualizar Telefono" size="sm" theme="primary"
    icon="fas fa-bell" v-centered static-backdrop scrollable>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="area" class="form-control inputTelefono" id="area" name="numArea" value="" required>
              <label for="area">Número de Area</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="tel" class="form-control inputTelefono" id="telefono" name="numTelefono" value="" required >
              <label for="telefono">Celular/Télefono</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-2">
              <select class="form-select inputTelefono" id="tipoTelefono" name="tipoTelefono" required >
                <option value="" selected>Seleccione...</option>
                <option value="P">Personal</option>
                <option value="C">Casa</option>
                <option value="F">Familiar</option>
                <option value="O">Otro</option>
              </select>
              <label for="tipoTelefono">Tipo de Télefono</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputTelefono" id="desTelefono" name="desTelefono">
              <label for="desTelefono">Descripción de Télefono</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="hidden" class="form-control inputTelefono" id="codigo" name="codigo" >
              <label for="codigo">Codigo</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="hidden" class="form-control inputTelefono" id="persona" value="{!! $row->codigo !!}" name="persona" >
              <label for="persona">Persona</label>
            </div>
          </div>
        </div>
      </section>
      <x-slot name="footerSlot">
        <x-adminlte-button type="submit"  theme="success" label="Actualizar"/>
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-modal>
  </form>
  
  <!--  -->
  <form action="{{route('updateRegistros', 'direcciones')}}" method="post">
    {!! csrf_field() !!}
    @method('put')
    {{-- Custom --}}
    <x-adminlte-modal id="modalDireccion" title="Actualizar Dirección" size="sm" theme="primary"
    icon="fas fa-bell" v-centered static-backdrop scrollable>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputDireccion" id="direccion" name="direccion" required>
              <label for="direccion">Dirección</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputDireccion" id="desDireccion" name="desDireccion">
              <label for="desDireccion">Referencia</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="hidden" class="form-control inputDireccion" id="codigo" name="codigo" >
              <label for="codigo">Codigo</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="hidden" class="form-control inputDireccion" id="persona" value="{!! $row->codigo !!}" name="persona" >
              <label for="persona">Persona</label>
            </div>
          </div>
        </div>
      </section>
      <x-slot name="footerSlot">
        <x-adminlte-button type="submit"  theme="success" label="Actualizar"/>
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-modal>
  </form>

  <!--  -->
  <form action="{{route('updateRegistros', 'correos')}}" method="post">
    {!! csrf_field() !!}
    @method('put')
    {{-- Custom --}}
    <x-adminlte-modal id="modalCorreo" title="Actualizar Correo" size="sm" theme="primary"
    icon="fas fa-bell" v-centered static-backdrop scrollable>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="text" class="form-control inputCorreo" id="correo" name="correo" required>
              <label for="correo">Correo Electrónico</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="hidden" class="form-control inputCorreo" id="codigo" name="codigo" >
              <label for="codigo">Codigo</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <div class="form-floating mb-2">
              <input type="hidden" class="form-control inputCorreo" id="persona" value="{!! $row->codigo !!}" name="persona" >
              <label for="persona">Persona</label>
            </div>
          </div>
        </div>
      </section>
      <x-slot name="footerSlot">
        <x-adminlte-button type="submit"  theme="success" label="Actualizar"/>
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-modal>
  </form>
@stop


@section('js')
  <script>
    $(document).ready(function() {
      let btnsEditar = document.querySelectorAll(".btnEditar");
      let btnsHidden = document.querySelectorAll(".hidden");
      let btnsCerrar = document.querySelectorAll(".btnCerrar");
      let inputsGeneral = document.querySelectorAll(".inputGeneral");
      let inputsTelefono = document.querySelectorAll(".inputTelefono");
      let inputsDireccion = document.querySelectorAll(".inputDireccion");
      let inputsCorreo = document.querySelectorAll(".inputCorreo");
      let btnsEliminar = document.querySelectorAll(".btnEliminar");
      let formsDelete = document.querySelectorAll(".formDelete");
      let data = {!! json_encode($data[0]) !!}
      let addImg = document.querySelector(".add-img");
      let inputFile = document.querySelector(".input-file");

      // Dar evento al input file cuando se da click en el texto
      addImg.addEventListener('click', e => { 
        inputFile.click();
      });

      //
      for (let i = 0; i < inputsGeneral[10].options.length; i++){
        if (inputsGeneral[10].options[i].innerHTML == data.cargo) inputsGeneral[10].options[i].selected = true;
      }

      //
      btnsEditar.forEach(el => {
        el.addEventListener("click", e => {
          if (el.classList.contains('editar1')){
            btnsHidden[0].classList.remove('d-none');
            btnsHidden[1].classList.remove('d-none');
            inputsGeneral.forEach(el => el.disabled = false);
            addImg.classList.remove('d-none');
            el.classList.add('d-none');
          }

          if (el.classList.contains('editar2')){
            axios.get("http://localhost/ClinicaMedica/public/persona/registro/get/telefono/"+el.getAttribute('id')).
              then(
                (respuesta)=>{
                  let edit = respuesta.data;
                  
                  inputsTelefono[0].value = edit.area;
                  inputsTelefono[1].value = edit.telefono;
                  for (let item of inputsTelefono[2].options) {
                    if(item.innerHTML == edit.tipo) item.selected = true;
                  }
                  inputsTelefono[3].value = edit.descripcion;
                  inputsTelefono[4].value = edit.codigo;
                  $("#modalTelefonos").modal("show");
                }
              ).
              catch(
                error => {
                  if(error.response){
                    console.log(error.response.data);
                  }
                }
              );
          
          }

          if (el.classList.contains('editar3')){
            axios.get("http://localhost/ClinicaMedica/public/persona/registro/get/direccion/"+el.getAttribute('id')).
              then(
                (respuesta)=>{
                  let edit = respuesta.data;
                  
                  inputsDireccion[0].value = edit.direccion;
                  inputsDireccion[1].value = edit.descripcion;
                  inputsDireccion[2].value = edit.codigo;
                  $("#modalDireccion").modal("show");
                }
              ).
              catch(
                error => {
                  if(error.response){
                    console.log(error.response.data);
                  }
                }
              );
          }

          if (el.classList.contains('editar4')){
            axios.get("http://localhost/ClinicaMedica/public/persona/registro/get/correo/"+el.getAttribute('id')).
              then(
                (respuesta)=>{
                  let edit = respuesta.data;
                  console.log(el.getAttribute('id'));
                  inputsCorreo[0].value = edit.correo;
                  inputsCorreo[1].value = edit.codigo;
                  $("#modalCorreo").modal("show");
                }
              ).
              catch(
                error => {
                  if(error.response){
                    console.log(error.response.data);
                  }
                }
              );
          }
        });
      });

      //
      btnsCerrar.forEach(el => {
        el.addEventListener("click", e => {
          if (el.classList.contains('cerrar1')){
            btnsHidden[0].classList.add('d-none');
            btnsHidden[1].classList.add('d-none');
            addImg.classList.add('d-none');
            btnsEditar[0].classList.remove('d-none');
            inputsGeneral.forEach(el => el.disabled = true);
            //inputsGeneral[0].value = {!! old('identidad') !!};
          }
        })
      });

      //
      formsDelete.forEach(el => {
        el.addEventListener('submit', e => {
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
      });

      


    });
  </script>

   @if (session('update') == 'ok')
    <script>
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '¡Registro Actualizado!',
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
@stop
