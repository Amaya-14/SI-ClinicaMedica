<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CajaFacturaController extends Controller
{
    public function ShowCaja(){
        $API = config('constants.HOST_API');
        //Cabeceras de las tablas(DataTables)
        $heads1 = $this->heads1();
        $heads2 = $this->heads2();

        $data1 = Http::get("{$API}/cyf/aperturaCierre")->object();
        $data2 = Http::get("{$API}/cyf/movimiento")->object();
        $data3 = Http::get("{$API}/cyf/cajas")->object();
        $count = 0;
        $count3 = 1;

        /* Factura*/

        return view('/caja/cajaChica', compact('heads1', 'data1', 'heads2', 'data2', 'data3', 'count', 'count3'));
    }

    public function getMovimientos(Request $request){
        $API = config('constants.HOST_API');
        //Cabeceras de las tablas(DataTables)
        $heads1 = $this->heads1();
        $heads2 = $this->heads2();


        $data1 = Http::get("{$API}/cyf/aperturaCierre/$request->fechaBusqueda")->object();
        $data2 = Http::get("{$API}/cyf/movimiento/$request->fechaBusqueda")->object();
        $data3 = Http::get("{$API}/cyf/cajas")->object();
        $count = 0;
        $count2 = 1;
        $count3 = 1;
        foreach ($data1 as $row){
            $row->fechaApertura = substr($row->fechaApertura, 0, 10);
            $row->fechaCierre = substr($row->fechaCierre, 0, 10);
        };
        

        return view('/caja/cajaChica', compact('heads1', 'data1', 'data2', 'heads2', "data3", 'count', 'count2', 'count3' ));
    }

    public function CreateCF(Request $request, $str){
        $API = config('constants.HOST_API');
        if($str == 'cajas'){
            Http::post('{$API}/cyf/caja', [
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);
        }

        if($str == 'apertura'){
            Http::post('{$API}/cyf/apertura', [
                'usuario' => $request->usuario,
                'caja' => $request->caja,
                'fecha' => $request->fecha,
                'cantidad' => $request->cantidad,
            ]);
        }
        return redirect()->route('CajaChica');
    }

    public function UpdateRegistro(Request $request, $cod){
        $API = config('constants.HOST_API');
        Http::put('{$API}/cyf/caja/$request->codigo', [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
    }

    public function DeleteRegistro($cod){
        $API = config('constants.HOST_API');
        Http::delete("{$API}/cyf/caja/$cod");
        return redirect()->route('CajaChica')->with('eliminar', 'ok');
    }

    // Retorna un arreglo que representa las cabceras de la tabla movimientos
    public function heads1(){
        $API = config('constants.HOST_API');
        return [
            '#',
            'Factura',
            'Tipo',
            'Cantidad',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];
    }

    // Retorna un arreglo que representa las cabceras de la tabla cajas
    public function heads2(){
        $API = config('constants.HOST_API');
        return [
            'Código',
            'Nombre',
            'Descripción',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];
    }
}
