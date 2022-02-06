<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RotacionController extends Controller
{
    public function ShowDistribucion(){
        $API = config('constants.HOST_API');
        $heads = [
            ['label' => '#', 'no-export' => false, 'width' => 8],
            'Empleado',
            'Días',
            'Entrada',
            'Salida',
            'Cargo',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $data = Http::get("{$API}/rotaciones")->object();

        $data2 = Http::get("{$API}/doctores")->object();

        $count = 1;

        return view("/rotacion/personal", compact('heads','data', 'data2', 'count'));
    }

    public function CreateRotacion(Request $request){
        $API = config('constants.HOST_API');
        Http::post('{$API}/rotacion', [
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
        $API = config('constants.HOST_API');
        Http::put("{$API}/rotacion/$request->rotacion", [
            'empleado' => $request->empleado,
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
        $API = config('constants.HOST_API');
        Http::delete("{$API}/rotacion/$cod");

        return redirect()->route('rotacion')->with('eliminar', 'ok');
    }
}
