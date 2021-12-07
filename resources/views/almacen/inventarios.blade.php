@extends('adminlte::page')

@section('title', 'Inventario')

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
          <a class="nav-link active" id="medicamentos-tab" data-toggle="tab" href="#medicamentos" role="tab" aria-controls="medicamentos" aria-selected="true">Medicamentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="materiales-tab" data-toggle="tab" href="#materiales" role="tab" aria-controls="materiales" aria-selected="false">Materiales</a>
        </li>
      </ul>
    </section>

    <section class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="medicamentos" role="tabpanel" aria-labelledby="medicamentos-tab">
          <x-adminlte-datatable id="tablaMedicamentos" :heads="$heads1" theme="light" striped hoverable beautify bordered compressed with-buttons>
            @foreach($data1 as $row)
              <tr>
                <td>{!! $row->codigo !!}</td>
                <td>{!! $row->medicamento !!}</td>
                <td>{!! $row->presentacion!!}</td>
                <td>{!! $row->tipo !!}</td>
                <td>
                  <nobr>
                    <a class="btn btn-xs btn-primary text-white mx-1 shadow" title="Editar">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>
                    <a href="{{route('detalles', ['medicamento',$row->codigo])}}" class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
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
            @foreach($data2 as $row)
              <tr>
                <td>{!! $row->codigo !!}</td>
                <td>{!! $row->material !!}</td>
                <td>{!! $row->tipo !!}</td>
                <td>
                  <nobr>
                    <a class="btn btn-xs btn-primary text-white mx-1 shadow" title="Editar">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <a class="btn btn-xs btn-danger text-white mx-1 shadow" title="Eliminar">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>
                    <a href="{{route('detalles', ['material',$row->codigo])}}" class="btn btn-xs btn-default bg-teal text-white mx-1 shadow" title="Detalles">
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
@stop

@section('js')
@stop
