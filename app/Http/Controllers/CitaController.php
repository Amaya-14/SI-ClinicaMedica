<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CitaController extends Controller
{
    public function ShowCita(){

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

        return view("/citas/agenda", compact('heads', 'data', 'data2', 'data3'));
    }

    public function CreateCita(Request $request){
        Http::post("http://localhost:3000/citas", [
            'paciente' => $request->paciente,
            'doctor' => $request->doctor,
            'fechaInicio' => $request->fechaInicio,
            'fechaFinal' => $request->fechaFinal,
            'horaInicio' => $request->horaInicio,
            'horaFinal' => $request->horaFinal,
            'estado' => $request->estado,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('citas')->with('create', 'ok');
    }

    public function GetCita($cod){
        $data = Http::get("http://localhost:3000/citas/$cod");
        return response()->json($data[0]);
    }

    public function UpdateCita(Request $request){
        Http::put("http://localhost:3000/citas/$request->codigo", [
            'paciente' => $request->paciente,
            'doctor' => $request->doctor,
            'fechaInicio' => $request->fechaInicio,
            'fechaFinal' => $request->fechaFinal,
            'horaInicio' => $request->horaInicio,
            'horaFinal' => $request->horaFinal,
            'estado' => $request->estado,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('citas')->with('update', 'ok');
    }

    public function DeleteCita(Request $request){
        Http::delete("http://localhost:3000/citas/$request->codigo");

        return redirect()->route('citas')->with('delete', 'ok');
    }
}
