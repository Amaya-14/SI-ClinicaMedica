@extends('adminlte::page')

@section('title', 'Detalles')

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

@section('content_header')
  @foreach ($data as $row )
      <x-adminlte-profile-widget name="{!! $row->nombres.' '.$row->apellidos !!}" desc="Administrator" theme="teal" img="https://picsum.photos/id/1/100" layout-type="classic">
        <section class="d-flex justify-content-between">
          <a href="{{route('registros','pacientes')}}" class="btn btn-outline-primary">Volver</a>
          <a href="#" class="btn btn-outline-primary">Imprimir</a>
        </section>

        <form action="#" method="post">
          @csrf
          @method('put')
          {{-- Fila 1 --}}
          <section class="row g-2 m-auto">
            <div class="d-flex justify-content-between">
              <h4 class="mt-2 mr-0 mb-0 ml-2">Datos Generales</h4>
              <div class="d-flex justify-content-end ">
                <a class="btn text-black " >
                  <i class="fa fa-lg fa-fw fa-edit btnEditar" title="Editar" id="editar1"></i>
                </a>
                <button type="submit" class="btn text-black hidden d-none" title="Guardar" id="guardar1">
                  <i class="fa fa-lg fa-fw fa-save"></i>
                </button>
                <a class="btn text-black hidden d-none" title="Cancelar" id="cancelar1">
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
                <input type="text" class="form-control editable" id="identidad" name="identidad" value="{!! $row->identidad !!}" placeholder="" required disabled>
                <label for="identidad">Número de Identidad</label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-floating mb-2">
                <input type="text" class="form-control editable" id="nacionalidad" name="nacionalidad" value="{!! $row->nacionalidad !!}" required disabled>
                <label for="nacionalidad">Nacionalidad</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-2">
                <input type="text" class="form-control editable" id="lastname" name="apellidos" value="{!! $row->apellidos !!}" placeholder="" required disabled>
                <label for="lastname">Apellidos</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-2">
                <input type="text" class="form-control editable" id="name" name="nombres" value="{!! $row->nombres !!}" required disabled>
                <label for="name">Nombres</label>
              </div>
            </div>
          </section>

          {{-- Fila 3 --}}
          <section class="row g-2 m-auto">
            <div class="col-sm-2">
              <div class="form-floating mb-2">
                <select class="form-select editable" id="sexo" name="sexo" required disabled>
                  <option selected disabled value="{!! substr($row->sexo,0,1) !!}">{!! $row->sexo !!}</option>
                  <option value="H">Hombre</option>
                  <option value="M">Mujer</option>
                </select>
                <label for="sexo">Sexo</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-2">
                <input type="date" class="form-control editable" id="fechaNacimiento" name="fechaNacimiento" value="{!! $row->fecha !!}" required disabled>
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-2">
                <input type="number" class="form-control editable" id="edad" name="edad" value="{!! $row->edad !!}" required disabled>
                <label for="edad">Edad</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-2">
                <select class="form-select editable" id="estadoCivil" name="estadoCivil" required disabled>
                  <option selected disabled value="{!! substr($row->estado_civil,0,1) !!}">{!! $row->estado_civil !!}</option>
                  <option value="S">Soltero</option>
                  <option value="C">Casado</option>
                  <option value="D">Divorciado</option>
                  <option value="V">Viudo/a</option>
                </select>
                <label for="estadoCivil">Estado Civil</label>
              </div>
            </div>
          </section>
        </form>

        <form action="{{route('updatePersonas', 'telefonos')}}" method="post">
          @csrf
          @method('put')
          {{-- Fila 4 --}}
          <section class="row g-2 m-auto">
            <div class="d-flex justify-content-between">
              <h4 class="mt-2 mr-0 mb-0 ml-2">Telefonos</h4>
              <div class="d-flex justify-content-end ">
                <a class="btn text-black " >
                  <i class="fa fa-lg fa-fw fa-edit btnEditar" title="Editar" id="editar2"></i>
                </a>
                <button type="submit" class="btn text-black hidden d-none" title="Guardar" id="guardar2">
                  <i class="fa fa-lg fa-fw fa-save"></i>
                </button>
                <a class="btn text-blacks hidden d-none" title="Cancelar" id="cancelar2">
                  <i class="fa fa-lg fa-fw fa-times"></i>
                </a>
              </div>  
            </div>
          </section>

          <div>
            <hr class="mt-0 mb-1 mr-0 ml-0">
          </div>

          {{-- Fila 5 --}}
          @foreach ($data2 as $row)
            <section class="row g-2 m-auto">
              <div class="col-sm-2">
                <div class="form-floating mb-2">
                  <input type="area" class="form-control editable" id="area" name="numArea" value="{!! $row->area !!}" required disabled>
                  <label for="area">Número de Area</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-2">
                  <input type="tel" class="form-control editable" id="telefono" name="numTelefono" value="{!! $row->telefono !!}" required disabled>
                  <label for="telefono">Celular/Télefono</label>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-floating mb-2">
                  <select class="form-select editable" id="tipoTelefono" name="tipoTelefono" required disabled>
                    <option value="{!! substr($row->tipo,0,1) !!}" selected disabled>{!! $row->tipo !!}</option>
                    <option value="P">Personal</option>
                    <option value="C">Casa</option>
                    <option value="F">Familiar</option>
                    <option value="O">Otro</option>
                  </select>
                  <label for="tipoTelefono">Tipo de Télefono</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control editable" id="desTelefono" name="desTelefono" value="{!! $row->descripcion !!}" disabled>
                  <label for="desTelefono">Descripción de Télefono</label>
                </div>
              </div>
            </section>
          @endforeach
        </form>

        <form action="#" method="post">
          @csrf
          @method('put')
          {{-- Fila 6 --}}
          <section class="row g-2 m-auto">
            <div class="d-flex justify-content-between">
              <h4 class="mt-2 mr-0 mb-0 ml-2">Direcciones</h4>
              <div class="d-flex justify-content-end ">
                <a class="btn text-black " >
                  <i class="fa fa-lg fa-fw fa-edit btnEditar" title="Editar" id="editar3"></i>
                </a>
                <button type="submit" class="btn text-black hidden d-none" title="Guardar" id="guardar3">
                  <i class="fa fa-lg fa-fw fa-save"></i>
                </button>
                <a class="btn text-blacks hidden d-none" title="Cancelar" id="cancelar3">
                  <i class="fa fa-lg fa-fw fa-times"></i>
                </a>
              </div>  
            </div>
          </section>

          <div>
            <hr class="mt-0 mb-1 mr-0 ml-0">
          </div>

          @foreach($data3 as $row)
            <section class="row g-2 m-auto">
              <div class="col-md">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control editable" id="direccion" name="direccion" value="{!! $row->direccion !!}" required disabled>
                  <label for="direccion">Dirección</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control editable" id="referencia" name="desDireccion" value="{!! $row->descripcion !!}" disabled>
                  <label for="referencia">Referencia</label>
                </div>
              </div>
            </section>
          @endforeach
        </form>

        <form action="#" method="post">
          @csrf
          @method('put')
          {{-- Fila 7 --}}
          <section class="row g-2 m-auto">
            <div class="d-flex justify-content-between">
              <h4 class="mt-2 mr-0 mb-0 ml-2">Correos</h4>
              <div class="d-flex justify-content-end ">
                <a class="btn text-black  " >
                  <i class="fa fa-lg fa-fw fa-edit btnEditar" title="Editar" id="editar4"></i>
                </a>
                <button type="submit" class="btn text-black hidden d-none" title="Guardar" id="guardar4">
                  <i class="fa fa-lg fa-fw fa-save"></i>
                </button>
                <a class="btn text-blacks hidden d-none" title="Cancelar" id="cancelar4">
                  <i class="fa fa-lg fa-fw fa-times"></i>
                </a>
              </div>  
            </div>
          </section>

          <div>
            <hr class="mt-0 mb-1 mr-0 ml-0">
          </div>
          
          <section class="row g-2 m-auto ">
            @foreach($data4 as $row)
              <div class="col-md">
                <div class="form-floating mb-2">
                  <input type="email" class="form-control editable" id="email" name="correo" value="{!! $row->correo !!}" required disabled>
                  <label for="email">Correo Electrónico</label>
                 </div>
              </div>
            @endforeach
          </section>
        </form>
      </x-adminlte-profile-widget>
    @endforeach
@stop

@section('content')
@stop

@section('js')
  <script>
    window.onload = function(){
      let inputs = document.getElementsByClassName("editable");
      let btns = document.getElementsByClassName("hidden");
      
      let btnsEditar = document.getElementsByClassName("btnEditar");
      let btnsGuardar = document.getElementsByClassName("btnGuardar");
      let btnsCancelar = document.getElementsByClassName("btnCancelar");

      let data = [];

      document.querySelectorAll(".btnEditar").forEach(el => {
        console.log(el);
        el.addEventListener("click", e => {
          let id = e.target.getAttribute("id");
          

          if (id == "editar1"){
            document.getElementById('editar1').classList.add("d-none");
            document.getElementById('guardar1').classList.remove("d-none");
            document.getElementById('cancelar1').classList.remove("d-none");
            document.getElementById('cancelar1').addEventListener("click",() => {
              document.getElementById('cancelar1').classList.add("d-none");
              document.getElementById('guardar1').classList.add("d-none");
              document.getElementById('editar1').classList.remove("d-none");
            });
          }

          if (id == "editar2"){
            document.getElementById('editar2').classList.add("d-none");
            document.getElementById('guardar2').classList.remove("d-none");
            document.getElementById('cancelar2').classList.remove("d-none");
            document.getElementById('cancelar2').addEventListener("click",() => {
              document.getElementById('cancelar2').classList.add("d-none");
              document.getElementById('guardar2').classList.add("d-none");
              document.getElementById('editar2').classList.remove("d-none");
            });
          }

          if (id == "editar3"){
            document.getElementById('editar3').classList.add("d-none");
            document.getElementById('guardar3').classList.remove("d-none");
            document.getElementById('cancelar3').classList.remove("d-none");
            document.getElementById('cancelar3').addEventListener("click",() => {
              document.getElementById('cancelar3').classList.add("d-none");
              document.getElementById('guardar3').classList.add("d-none");
              document.getElementById('editar3').classList.remove("d-none");
            });
          }

          if (id == "editar4"){
            document.getElementById('editar4').classList.add("d-none");
            document.getElementById('guardar4').classList.remove("d-none");
            document.getElementById('cancelar4').classList.remove("d-none");
            document.getElementById('cancelar4').addEventListener("click",() => {
              document.getElementById('cancelar4').classList.add("d-none");
              document.getElementById('guardar4').classList.add("d-none");
              document.getElementById('editar4').classList.remove("d-none");
            });
          }
        });
      });
    }
    

    /* Habilita los inputs para cambiar su valor y oculta el boton editar */
    function edit(){
      for (let i = 0; i<inputs.length; i++) inputs[i].disabled = false;
      for (let i = 0; i<btns.length; i++) btns[i].classList.remove("d-none");
      btnEditar.classList.add("d-none");
      getValues();
    }

    /* Oculta los botones cancelar y guardar, llama a la función restoreValues */
    function cancel(){
      for (let i = 0; i<inputs.length; i++) inputs[i].disabled = true;
      for (let i = 0; i<btns.length; i++) btns[i].classList.add("d-none");
      btnEditar.classList.remove("d-none");
      restoreValues();
    }

    /* Almacena en un arreglo los valores de los inputs antes de modificarlos */
    function getValues(){
      for (let i = 0; i<inputs.length; i++) data.push(inputs[i].value);
      //console.log(data);
    }

    /* Restaura los valores de los inputs */
    function restoreValues(){
      for (let i = 0; i<inputs.length; i++){
        (inputs[i].classList.contains("form-control")) ? inputs[i].value = data[i] : inputs[i].options[0].selected = true;
      } 
    }
    console.log(type("danie".substr(-1)));
  </script>
@stop
