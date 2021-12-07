<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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

        $data = Http::get("http://localhost:3000/citas")->object();

        $data2 = Http::get("http://localhost:3000/pacientes")->object();

        $data3 = DB::select("CALL sp_select_persona('doctores',0);");

        return view("/citas/{$vista}", compact('heads', 'data', 'data2', 'data3'));
    }
}
