@extends('adminlte::page')

@section('title', 'Productos')

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">

  <!-- Bootstrap -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    .d-flex > p{
      margin:0;
    }
  </style>
  
@stop

@section('content_header')
  <div class="row g-2">
    <div class="col-md-3">
      <x-adminlte-card theme="lightblue" theme-mode="outline">
        @foreach($producto as $item)
          <form>
            <div class="row g-2">
              <div class="col-md">
                <a href="{{route('productos')}}" class="text-black" title="Volver">
                  <i class="fa fa-lg fa-fw fa-long-arrow-alt-left"></i>
                </a>  
              </div>
              <div class="col-md">
                <div class="d-flex justify-content-end ">
                  <a href="#" class="text-black " >
                    <i class="fa fa-lg fa-fw fa-edit btnEditar" title="Editar" id="editar1"></i>
                  </a>
                  <button type="submit" class="text-black hidden d-none" title="Guardar" id="guardar1">
                    <i class="fa fa-lg fa-fw fa-save"></i>
                  </button>
                  <a href="#" class="text-black hidden d-none" title="Cancelar" id="cancelar1">
                    <i class="fa fa-lg fa-fw fa-times"></i>
                  </a>
                </div>
              </div>
            </div>
            <hr class="mb-1 mt-0">
            <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control" value="{!! $item->nombre !!}" id="nombreMe" name="nombre" placeholder="Medicamento" disabled required>
                  <label for="nombreMe">Medicamento</label>
                </div>
              </div>
            </div>
            <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-2">
                  <select class="form-select" id="presentacionMe" name="presentacion" disabled required>
                    <option selected disabled value="0">{!! $item->presentacion !!}</option>
                  </select>
                  <label for="presentacionMe">Presentación</label>
                </div>
              </div>
            </div>
            <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-2">
                  <select class="form-select" id="tipoMe" name="tipo" disabled required>
                    <option selected disabled value="0">{!! $item->tipo !!}</option>
                  </select>
                  <label for="tipoMe">Tipo</label>
                </div>
              </div>
            </div>
            <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control" placeholder="Descripción" value="{!! $item->descripcion !!}" id="descripcionMe" name="descripcion" disabled>
                  <label for="descripcionMe">Descripción (Opcional)</label>
                </div>
              </div>
            </div>
          </form>
        @endforeach
      </x-adminlte-card>
    </div>  
    <div class="col-md">
      <x-adminlte-card theme="lightblue" theme-mode="outline">
        <x-adminlte-datatable id="tablaInventario" :heads="$heads" theme="light" striped hoverable beautify bordered compressed>
          @foreach($inventario as $row)
            <tr>
              <td>1</td>
              <td>{!! $row->tipo !!}</td>
              <td>{!! $row->cantidad !!}</td>
              <td>{!! $row->fecha !!}</td>
              <td>{!! $row->lote !!}</td>
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
      </x-adminlte-card>
    </div>  
  </div>
@stop

@section('content')
@stop

@section('js')
@stop
