@extends('adminlte::page')

@section('title', 'Productos')

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
    .modal-content{
      width: 430px;
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
        <div class="col-md">
          <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="medicamentos-tab" data-toggle="tab" href="#medicamentos" role="tab" aria-controls="medicamentos" aria-selected="true">Medicamentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="materiales-tab" data-toggle="tab" href="#materiales" role="tab" aria-controls="materiales" aria-selected="false">Materiales</a>
            </li>
          </ul>
        </div>
        <div class="col-md d-flex justify-content-end">
          <a class="btn bg-teal" data-toggle="modal" data-target="#modalMedicamentosPost" id="btn-nuevo-registro">Nuevo Medicamento</a>
        </div>
      </div>
    </section>

    <section class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="medicamentos" role="tabpanel" aria-labelledby="medicamentos-tab">
          <x-adminlte-datatable id="tablaMedicamentos" :heads="$heads1" theme="light" striped hoverable beautify bordered compressed with-buttons>
            @foreach($medicamentos as $row)
              <tr>
                <td>{!! $count1++ !!}</td>
                <td>{!! $row->nombre !!}</td>
                <td>{!! $row->presentacion!!}</td>
                <td>{!! $row->tipo !!}</td>
                <td>
                  <nobr>
                    <form class="formEliminar" action="{{route('deleteProducto', ['medicamentos',$row->codigo])}}" method="post">
                      @csrf
                      @method('delete')
                      <button class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>
                    </form>
                    <a class="btn btn-xs btn-default bg-teal text-white mx-1 shadow btnDetalles detalles1" title="Detalles" data-toggle="modal" data-target="#modalMedicamentosPut" id="{!! $count1 !!}">
                      <i class="fa fa-lg fa-fw fa-eye" id="{!! $count1 !!}"></i>
                    </a>
                  </nobr>
                </td>
              </tr>
            @endforeach
          </x-adminlte-datatable>
        </div>
        <div class="tab-pane" id="materiales" role="tabpanel" aria-labelledby="materiales-tab">
          <x-adminlte-datatable id="tablaMateriales" :heads="$heads2" theme="light" striped hoverable beautify bordered compressed with-buttons>
            @foreach($materiales as $row)
              <tr>
                <td>{!! $count2++ !!}</td>
                <td>{!! $row->nombre !!}</td>
                <td>{!! $row->tipo !!}</td>
                <td>{!! $row->descripcion !!}</td>
                <td>
                  <nobr>
                    <form class="formEliminar" action="{{route('deleteProducto', ['materiales',$row->codigo])}}" method="post">
                      @csrf
                      @method('delete')
                      <button class="btn btn-xs btn-danger text-white mx-1 shadow btnElimnar" title="Eliminar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>
                    </form>
                    <a class="btn btn-xs btn-default bg-teal text-white mx-1 shadow btnDetalles detalles2" title="Detalles" data-toggle="modal" data-target="#modalMaterialesPut" id="{!! $count2 !!}">
                      <i class="fa fa-lg fa-fw fa-eye" id="{!! $count2 !!}"></i>
                    </a>
                  </nobr>
                </td>
              </tr>
            @endforeach
          </x-adminlte-datatable>
        </div>
      </div>
    </section>
  </div>
@stop

@section('content')
  <!-- Formulario para agregar un medicamento -->
  <form action="{{route('nuevoProducto', 'medicamento')}}" method="post">
    @csrf
    <x-adminlte-modal id="modalMedicamentosPost" title="Nuevo Medicamento" theme="teal" icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombreMe" name="nombre" placeholder="Medicamento" required>
              <label for="nombreMe">Medicamento</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="presentacionMe" name="presentacion" required>
                <option selected disabled value="">Seleccione</option>
                @foreach($presentaciones as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="presentacionMe">Presentación</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="tipoMe" name="tipo" required>
                <option selected disabled value="">Seleccione</option>
                @foreach($tipoMedicamentos as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="tipoMe">Tipo</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <textarea class="form-control" placeholder="Descripción" id="descripcionMe" name="descripcion"></textarea>
              <label for="descripcionMe">Descripción (Opcional)</label>
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

  <!-- Formulario para actualizar un medicamento -->
  <form action="{{route('updateProducto', 'medicamentos')}}" method="post">
    @csrf
    @method('put')
    <x-adminlte-modal class="Modal" id="modalMedicamentosPut" title="Medicamento" theme="primary" icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control inputU update1" id="nombreMe" name="nombre" placeholder="Medicamento" disabled required>
              <label for="nombreMe">Medicamento</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select inputU update1" id="presentacionMe" name="presentacion" disabled required>
                <option selected value="">Seleccione</option>
                @foreach($presentaciones as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="presentacionMe">Presentación</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select inputU update1" id="tipoMe" name="tipo" disabled required>
                <option selected value="">Seleccione</option>
                @foreach($tipoMedicamentos as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="tipoMe">Tipo</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <textarea class="form-control inputU update1" placeholder="Descripción" id="descripcionMe" name="descripcion" disabled></textarea>
              <label for="descripcionMe">Descripción (Opcional)</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <input type="number" class="inputU update1" id="codigoMe" name="codigoMe">
          </div>
        </div>
      </section>
      <x-slot name="footerSlot">
        <a class="btn btn-warning btnEditar editar1" id="btnEditar1">Editar</a>
        <x-adminlte-button class="d-none btnHidden hidden1" type="submit"  theme="success" label="Actualizar"/>
        <x-adminlte-button class="d-none btnHidden hidden1" theme="danger" label="Cancelar" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-modal>
  </form>

  <!-- Formulario para agregar un material -->
  <form action="{{route('nuevoProducto', 'material')}}" method="post">
    @csrf
    <x-adminlte-modal id="modalMaterialesPost" title="Nuevo Material" theme="teal" icon="fas fa-bell" v-centered static-backdrop>  
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombreMa" name="nombre" placeholder="Medicamento" required>
              <label for="nombreMa">Material</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select" id="tipoMa" name="tipo" required>
                <option selected disabled value="">Seleccione</option>
                @foreach($tipoMateriales as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="tipoMa">Tipo</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <textarea class="form-control" placeholder="Descripción" id="descripcionMa" name="descripcion"></textarea>
              <label for="descripcionMa">Descripción (Opcional)</label>
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

  <!-- Formulario para actualizar un material -->
  <form action="{{route('updateProducto', 'materiales')}}" method="post">
    @csrf
    @method('put')
    <x-adminlte-modal class="Modal" id="modalMaterialesPut" title="Material" theme="primary" icon="fas fa-bell" v-centered static-backdrop>
      <section>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <input type="text" class="form-control inputU update2" id="nombreMa" name="nombre" placeholder="Medicamento" disabled required>
              <label for="nombreMa">Material</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <select class="form-select inputU update2" id="tipoMa" name="tipo" disabled required>
                <option selected value="">Seleccione</option>
                @foreach($tipoMateriales as $row)
                  <option value="{!! $row->codigo !!}">{!! $row->nombre !!}</option>
                @endforeach
              </select>
              <label for="tipoMa">Tipo</label>
            </div>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating mb-3">
              <textarea class="form-control inputU update2" placeholder="Descripción" id="descripcionMa" name="descripcion" disabled></textarea>
              <label for="descripcionMa">Descripción (Opcional)</label>
            </div>
          </div>
        </div>
        <div class="row g-2 d-none">
          <div class="col-md">
            <input type="number" class="inputU update2" id="codigoMa" name="codigoMa">
          </div>
        </div>
      </section>
      <x-slot name="footerSlot">
        <a class="btn btn-warning btnEditar editar2" id="btnEditar2">Editar</a>
        <x-adminlte-button class="d-none btnHidden hidden2" type="submit"  theme="success" label="Actualizar"/>
        <x-adminlte-button class="d-none btnHidden hidden2" theme="danger" label="Cancelar" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-modal>
  </form>
  
@stop

@section('js')

  <script>
    $(document).ready(function() {
      // variables
      let fromsElimnar = document.querySelectorAll(".formElimanar");
      let BtnsDetalles = document.querySelectorAll(".btnDetalles");
      let BtnsEditar = document.querySelectorAll('.btnEditar');
      let hidden = document.querySelectorAll('.btnHidden');
      let inputsU = document.querySelectorAll('.inputU');
      let modals = document.querySelectorAll('.Modal');
      let body = document.querySelectorAll('body');
      //body.classList.add('pace-big-counter');
      let data1 = {!! json_encode($medicamentos) !!};
      let data2 = {!! json_encode($materiales) !!};
      console.log(data1);
      console.log(data2);
      console.log(inputsU);
      console.log(inputsU[0]);
      console.log(inputsU[1]);

      //
      BtnsDetalles.forEach(el => {
        el.addEventListener("click", e => {
          let id = e.target.getAttribute('id');
          id -= 2;
          if(el.classList.contains('detalles1')){
            let data = {!! json_encode($medicamentos) !!};
            inputsU[0].value = data[id].nombre;
            inputsU[1].options[0].innerHTML = data[id].presentacion;
            inputsU[1].options[0].value = data[id].codigoP;
            inputsU[2].options[0].innerHTML = data[id].tipo;
            inputsU[2].options[0].value = data[id].codigoT;
            inputsU[3].value = data[id].descripcion;
            inputsU[4].value = data[id].codigo;
          }
          
          if(el.classList.contains('detalles2')){
            let data = {!! json_encode($materiales) !!};
            inputsU[5].value = data[id].nombre;
            inputsU[6].options[0].innerHTML = data[id].tipo;
            inputsU[6].options[0].value = data[id].codigoT;
            inputsU[7].value = data[id].descripcion;
            inputsU[8].value = data[id].codigo;
          }
        });
      });

      //
      BtnsEditar.forEach(el => {
        el.addEventListener("click", e => {
          if(el.classList.contains('editar1')) {
            //el.classList.add('d-none');
            ShowBtns(el,'hidden1');
            inputsU.forEach(i => {
              if(i.classList.contains('update1')) i.disabled = false;  
            });
          };

          if(el.classList.contains('editar2')) {
            //el.classList.add('d-none');
            ShowBtns(el, 'hidden2');
            inputsU.forEach(i => {
              if(i.classList.contains('update2')) i.disabled = false;  
            });

          };
        });
      });

      //
      modals.forEach(el => {
        $(`#${el.getAttribute('id')}`).on('hidden.bs.modal', e =>{
          inputsU.forEach(el => {
            if(el.classList.contains('update1')){
              if (!el.disabled) el.disabled = true;
              HiddenBtns(BtnsEditar[0], 'hidden1');
            }

            if(el.classList.contains('update2')){
              if (!el.disabled) el.disabled = true;
              HiddenBtns(BtnsEditar[1], 'hidden2');
            }
          });
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

      //
      document.querySelectorAll(".nav-link").forEach(el => {
        el.addEventListener("click", e => {
          const id = e.target.getAttribute("id");
          let button = document.getElementById('btn-nuevo-registro');
          
          if (id === 'materiales-tab') {
            button.dataset.target = '#modalMaterialesPost';
            if (button.innerHTML !== 'Nuevo Material') button.innerHTML = 'Nuevo Material';
          }

          if(id === 'medicamentos-tab') {
            button.dataset.target = '#modalMedicamentosPost';
            if (button.innerHTML !== 'Nuevo Medicamento') button.innerHTML = 'Nuevo Medicamento';
          }
        });
      });

      //
      function ShowBtns(btn, id){
        btn.classList.add("d-none");
        hidden.forEach(el => {
          if(el.classList.contains(id)) {
            el.classList.remove('d-none');
          }
        });
      }
      
      //
      function HiddenBtns(btn, id){
        btn.classList.remove("d-none");
        hidden.forEach(el => {
          if(el.classList.contains(id)) {
            el.classList.add('d-none');
          }
        });
      }
    });
  </script>

  <script></script>
@stop
