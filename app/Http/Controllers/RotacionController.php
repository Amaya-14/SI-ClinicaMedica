<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RotacionController extends Controller
{
    public function ShowDistribucion(){

        $heads = [
            ['label' => '#', 'no-export' => false, 'width' => 8],
            'Empleado',
            'Días',
            'Entrada',
            'Salida',
            'Cargo',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $data = Http::get("http://localhost:3000/rotaciones")->object();

        $data2 = Http::get("http://localhost:3000/empleados")->object();

        $count = 1;

        return view("/rotacion/personal", compact('heads','data', 'data2', 'count'));
    }

    public function CreateRotacion(Request $request){

        Http::post('http://localhost:3000/rotacion', [
            'codigo' => $request->codigo,
            'dias' => $request->dias,
            'entrada' => $request->entrada,
            'salida' => $request->salida,
            'jornada' => $request->jornada,
            'color' => $request->color,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('rotacion');
    }

    public function UpdateRotacion(Request $request, $cod){

        Http::put("http://localhost:3000/rotacion/$request->rotacion", [
            'empleado' => $request->codigo,
            'dias' => $request->dias,
            'entrada' => $request->entrada,
            'salida' => $request->salida,
            'jornada' => $request->jornada,
            'color' => $request->color,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('rotacion');
    }

    public function DeleteRotacion($cod){

        Http::delete("http://localhost:3000/rotacion/$cod");

        return redirect()->route('rotacion');
    }
}
