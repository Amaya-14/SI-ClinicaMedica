<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RotacionController extends Controller
{
    public function ShowDistribucion(){

        $heads = [
            ['label' => 'Código', 'no-export' => false, 'width' => 8],
            'Empleado',
            'Días',
            'Entrada',
            'Salida',
            'Cargo',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $data = Http::get("http://localhost:3000/rotaciones")->object();
        //$data = DB::select("CALL sp_select_rotacion(0);");

        $data2 = Http::get("http://localhost:3000/empleados")->object();
        //$data2 = DB::select("CALL sp_select_pacientesORempleados('empleados',0);");

        return view("/rotacion/personal", compact('heads','data', 'data2'));
    }
}
