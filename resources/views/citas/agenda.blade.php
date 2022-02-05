@extends('adminlte::page')

@section('title', 'Citas')

@section('css')
  <!--<link rel="stylesheet" href="/css/admin_custom.css">-->

  <!-- Bootstrap -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
@stop

@section('content_header')
  <x-adminlte-card theme="lightblue " theme-mode="outline">
    <div id="calendarCitas"></div>
  </x-adminlte-card>
@stop

@section('content')
    <form class="formCitaCreate" action="{{route('createCitas')}}" method="post">
      {!! csrf_field() !!}
      <x-adminlte-modal id="modalCitaCreate" title="Nueva Cita" size="lg" theme="teal" icon="fas fa-bell" v-centered static-backdrop scrollable>
        <section>
          {{-- Fila 1 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                  <select class="form-select" id="paciente" name="paciente" required>
                    <option selected disabled value="">Seleccione</option>
                    @foreach($data2 as $row)
                      <option value="{!! $row->codigo !!}">{!! $row->nombres." ".$row->apellidos !!}</option>
                    @endforeach
                  </select>
                  <label form="paciente">Paciente</label>
              </div>
            </div>
            <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select" id="doctor" name="doctor" required>
                    <option selected disabled value="">Seleccione</option>
                    @foreach($data3 as $row)
                      <option value="{!! $row->codigo !!}">{!! $row->nombres." ".$row->apellidos !!}</option>
                    @endforeach
                  </select>
                  <label form="doctor">Doctor/a</label>
                </div>
            </div>
          </div>
          {{-- Fila 2 --}}
          <div class="row g-2">
              <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                    <label for="fechaInicio">Fecha Cita Inicio</label>
                  </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" required>
                  <label for="fechaFinal">Fecha Cita Final</label>
                </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="time" class="form-control" id="horaInicio" name="horaInicio" placeholder="00:00" required>
                      <label for="horaInicio">Hora Inicio</label>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="time" class="form-control" id="horaFinal" name="horaFinal" placeholder="00:00" required>
                      <label for="horaFinal">Hora Final</label>
                  </div>
              </div>
          </div>
          {{-- Fila 3 --}}
          <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select" id="estado" name="estado" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="L">Libre</option>
                    <option value="T">Tentativo</option>
                    <option value="O">Ocupado</option>
                    <option value="A">Ausente</option>
                  </select>
                  <label for="estado">Estado</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select" id="tipo" name="tipo" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="N">Normal</option>
                    <option value="Q">Quirurgico</option>
                  </select>
                  <label for="tipo">Tipo de Cita</label>
                </div>
              </div>
          </div>
          {{-- Fila 4 --}}
          <div class="row g-2">
              <div class="col-md">
                  <div class="form-floating">
                      <textarea class="form-control" placeholder="Descripción" id="descripcion" name="descripcion"></textarea>
                      <label for="descripcion">Descripción (Opcional)</label>
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

    <form class="formCitaUpdate" action="{{route('updateCitas')}}" method="post">
      {!! csrf_field() !!}
      @method('put')
      <x-adminlte-modal id="modalCitaUpdate" title="Cita" size="lg" theme="primary" icon="fas fa-bell" v-centered static-backdrop scrollable>
        <section>
          {{-- Fila 1 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
                  <select class="form-select inputUpdate" id="paciente" name="paciente" disabled required>
                    <option selected disabled value="">Seleccione</option>
                    @foreach($data2 as $row)
                      <option value="{!! $row->codigo !!}">{!! $row->nombres." ".$row->apellidos !!}</option>
                    @endforeach
                  </select>
                  <label form="paciente">Paciente</label>
              </div>
            </div>
            <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select inputUpdate" id="doctor" name="doctor" disabled required>
                    <option selected disabled value="">Seleccione</option>
                    @foreach($data3 as $row)
                      <option value="{!! $row->codigo !!}">{!! $row->nombres." ".$row->apellidos !!}</option>
                    @endforeach
                  </select>
                  <label form="doctor">Doctor/a</label>
                </div>
            </div>
          </div>
          {{-- Fila 2 --}}
          <div class="row g-2">
              <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="date" class="form-control inputUpdate" id="fechaInicio" name="fechaInicio" disabled required>
                    <label for="fechaInicio">Fecha Cita Inicio</label>
                  </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="date" class="form-control inputUpdate" id="fechaFinal" name="fechaFinal" disabled required>
                  <label for="fechaFinal">Fecha Cita Final</label>
                </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="time" class="form-control inputUpdate" id="horaInicio" name="horaInicio" placeholder="00:00" disabled required>
                      <label for="horaInicio">Hora Inicio</label>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="time" class="form-control inputUpdate" id="horaFinal" name="horaFinal" placeholder="00:00" disabled required>
                      <label for="horaFinal">Hora Final</label>
                  </div>
              </div>
          </div>
          {{-- Fila 3 --}}
          <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select inputUpdate" id="estado" name="estado" disabled required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="L">Libre</option>
                    <option value="T">Tentativo</option>
                    <option value="O">Ocupado</option>
                    <option value="A">Ausente</option>
                  </select>
                  <label for="estado">Estado</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <select class="form-select inputUpdate" id="tipo" name="tipo" disabled required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="N">Normal</option>
                    <option value="Q">Quirurgico</option>
                  </select>
                  <label for="tipo">Tipo de Cita</label>
                </div>
              </div>
          </div>
          {{-- Fila 4 --}}
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating">
                <textarea class="form-control inputUpdate" placeholder="Descripción" id="descripcion" name="descripcion" disabled></textarea>
                <label for="descripcion">Descripción (Opcional)</label>
              </div>
            </div>
            <div class="col-md d-none">
              <div class="form-floating mb-3">
                <input class="form-control" type="number" id="codigo" name="codigo" required>
                <label for="codigo">codigo</label>
              </div>
            </div>  
          </div>
        </section>
        <x-slot name="footerSlot">
          <a class="btn btn-warning btnEditar">Editar</a>
          <x-adminlte-button class="btnActualizar d-none" type="submit"  theme="success" label="Actualizar"/>
          <x-adminlte-button class="btnElimanar" theme="danger" label="Eliminar"/>
        </x-slot>
      </x-adminlte-modal>
    </form>

    <form class="formCitaEliminar" action="{{route('deleteCita')}}" method="post">
      {!! csrf_field() !!}
      @method('delete')
      <div class="form-floating mb-3 d-none">
        <input class="form-control" type="number" id="codigo" name="codigo" required>
        <label for="codigo">codigo</label>
      </div>
    </form>
@stop

@section('js')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let formCreate = document.querySelector('.formCitaCreate');
      let formUpdate = document.querySelector('.formCitaUpdate');
      let formEliminar = document.querySelector('.formCitaEliminar');
      let citas = {!! json_encode($data) !!};
      let calendarEl = document.getElementById('calendarCitas');
      let inputsUpdate = document.querySelectorAll('.inputUpdate');
      let btnEditar = document.querySelector('.btnEditar');
      let btnActualizar = document.querySelector('.btnActualizar');
      let btnEliminar = document.querySelector('.btnElimanar');

      let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        editable: false,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
        },
        events: citas,
        themeSystem: 'bootstrap',
        dateClick: function(info) {
          formCreate.reset();
          formCreate.fechaInicio.value = info.dateStr;
          formCreate.fechaInicio.min = info.dateStr;
          formCreate.fechaInicio.max = info.dateStr;
          formCreate.fechaFinal.value = info.dateStr;
          formCreate.fechaFinal.min = info.dateStr;
          $("#modalCitaCreate").modal("show");
        },
        eventClick: function(info){
          //let evento = info.event;
          axios.get("http://localhost/ClinicaMedica/public/cita/get/"+info.event.extendedProps.codigo).
          then(
            (respuesta)=>{
              console.log(respuesta);
              let edit = respuesta.data;
              for (let item of formUpdate.paciente.options) {
                if(item.innerHTML == edit.title) item.selected = true;
              }

              for (let item of formUpdate.doctor.options) {
                if(item.innerHTML == edit.doctor) item.selected = true;
              }

              formUpdate.fechaInicio.value = edit.start.substr( 0, 10);
              formUpdate.fechaFinal.value = edit.end.substr( 0, 10);
              
              for (let item of formUpdate.estado.options){
                if(item.innerHTML == edit.estado) item.selected = true;
              }

              for (let item of formUpdate.tipo.options){
                if(item.innerHTML == edit.tipo) item.selected = true;
              }

              formUpdate.horaInicio.value = edit.hInicio;
              formUpdate.horaFinal.value = edit.hFinal;
              formUpdate.codigo.value = edit.codigo;
              
              formUpdate.descripcion.value = edit.descripcion;

              formEliminar.codigo.value = edit.codigo;
              $("#modalCitaUpdate").modal("show");
            }
          ).
          catch(
            error => {
              if(error.response){
                console.log(error.response.data);
              }
            }
          );
        },
      });

      calendar.render();

      btnEditar.addEventListener('click' , () =>{
        inputsUpdate.forEach(el => el.disabled = false);
        btnEditar.classList.add('d-none');
        btnActualizar.classList.remove('d-none');
      });

      $('#modalCitaUpdate').on('hidden.bs.modal', function (e) {
        if(btnEditar.classList.contains('d-none')){
          inputsUpdate.forEach(el => el.disabled = true);
          btnEditar.classList.remove('d-none');
          btnActualizar.classList.add('d-none');
        }
      });

      btnEliminar.addEventListener('click', () => {
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
            formEliminar.submit();
          }
        });
      });

    });
  </script>

  @if (session('create') == 'ok')
    <script>
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '¡Cita Agregada!',
        iconColor: '#00a135', 
        showConfirmButton: false,
        timer: 3200,  
      })
    </script>
  @endif

  @if (session('update') == 'ok')
    <script>
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '¡Cita Actualizada!',
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
