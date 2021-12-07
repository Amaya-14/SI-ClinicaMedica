<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function ShowCita($vista){

        $heads = [
            '#',
            'PACIENTE',
            'MEDICO',
            'FECHA',
            'INICIO',
            'FINAL',
            'ESTADO',
            'TIPO DE CITA',
            ['label' => 'OPCIONES', 'no-export' => true, 'width' => 15],
        ];

        $config = [
            /*
            'data' => [ [] ],*/

            //'order' => [[1, 'asc']],
            //'columns' => [null, null, null, ['orderable' => false]],
        ];

        $data = DB::select("CALL sp_select_cita();");

        $data2 = DB::select("CALL sp_select_pacientesORempleados('pacientes',0);");

        $data3 = DB::select("CALL sp_select_persona('doctores',0);");

        return view("/citas/{$vista}", compact('heads', 'data', 'data2', 'data3'));
    }
}
