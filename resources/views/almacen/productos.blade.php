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
          <a class="btn bg-teal" data-toggle="modal" data-target="#modalMedicamentos" id="btn-nuevo-registro">Nuevo Medicamento</a>
        </div>
      </div>
    </section>

    <section class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="medicamentos" role="tabpanel" aria-labelledby="medicamentos-tab">
          <x-adminlte-datatable id="tablaMedicamentos" :heads="$heads1" theme="light" striped hoverable beautify bordered compressed with-buttons>
            @foreach($medicamentos as $row)
              <tr>
                <td>{!! $row->codigo !!}</td>
                <td>{!! $row->nombre !!}</td>
                <td>{!! $row->presentacion!!}</td>
                <td>{!! $row->tipo !!}</td>
                <td>
                  <nobr>
                    <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>
                    <a href="{{route('infoProducto', ['medicamentos',$row->codigo])}}" class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
                      <i class="fa fa-lg fa-fw fa-eye"></i>
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
                <td>{!! $row->codigo !!}</td>
                <td>{!! $row->nombre !!}</td>
                <td>{!! $row->tipo !!}</td>
                <td>
                  <nobr>
                    <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>
                    <a href="{{route('infoProducto', ['materiales',$row->codigo])}}" class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
                      <i class="fa fa-lg fa-fw fa-eye"></i>
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
  <!-- Formulario para agregar un nuevo medicamento -->
  <form action="{{route('nuevoProducto', 'medicamento')}}" method="post">
    @csrf
    <x-adminlte-modal id="modalMedicamentos" title="Nuevo Medicamento" theme="teal" icon="fas fa-bell" v-centered static-backdrop>  
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

  <!-- Formulario para agregar un nuevo material -->
  <form action="{{route('nuevoProducto', 'material')}}" method="post">
    @csrf
    <x-adminlte-modal id="modalMateriales" title="Nuevo Material" theme="teal"
    icon="fas fa-bell" v-centered static-backdrop>  
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
@stop

@section('js')
  <script>
    document.querySelectorAll(".nav-link").forEach(el => {
      el.addEventListener("click", e => {
        const id = e.target.getAttribute("id");
        let button = document.getElementById('btn-nuevo-registro');
        
        if (id === 'materiales-tab') {
          button.dataset.target = '#modalMateriales';
          if (button.innerHTML !== 'Nuevo Material') button.innerHTML = 'Nuevo Material';
        }

        if(id === 'medicamentos-tab') {
          button.dataset.target = '#modalMedicamentos';
          if (button.innerHTML !== 'Nuevo Medicamento') button.innerHTML = 'Nuevo Medicamento';
        }
      });
    });
  </script>
@stop
