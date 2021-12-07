<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlmacenController extends Controller
{
    public function ShowProductos(){

        $heads1 = [
            'CODIGO',
            'NOMBRE',
            'PRESENTACIÓN',
            'TIPO',
            ['label' => 'OPCIONES', 'no-export' => true, 'width' => 15],
        ];

        $medicamentos = Http::get("http://localhost:3000/medicamentos")->object();
        $presentaciones = Http::get("http://localhost:3000/upresentacion")->object();
        $tipoMedicamentos = Http::get("http://localhost:3000/tipmedicamentos")->object();

        $heads2 = [
            'CODIGO',
            'NOMBRE',
            'TIPO',
            ['label' => 'OPCIONES', 'no-export' => true, 'width' => 15],
        ];

        $materiales = Http::get("http://localhost:3000/materiales")->object();
        $tipoMateriales = Http::get("http://localhost:3000/tipmaterial")->object();

        return view("/almacen/productos", compact('heads1', 'medicamentos', 'presentaciones', 'tipoMedicamentos','heads2', 'materiales', 'tipoMateriales'));
    }

    public function CreateProducto(Request $request, $str){

        Http::post("http://localhost:3000/{$str}", [
            'nombre' => $request->nombre,
            'presentacion' => $request->presentacion,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('productos');
    }

    public function ShowInfoProducto($str, $cod){
        $heads = [
            '#',
            'REGISTRO',
            'CANTIDAD',
            'FECHA VENCIMIENTO',
            'LOTE',
            ['label' => 'OPCIONES', 'no-export' => true, 'width' => 15],
        ];

        $producto = Http::get("http://localhost:3000/{$str}/{$cod}")->object();
        $str = 'i'.$str;
        $inventario = Http::get("http://localhost:3000/{$str}/{$cod}")->object();

        return view("/almacen/detalle", compact('heads', 'producto', 'inventario'));
    }


    public function GetMedicamento($cod){
        $open = 'show';
        $medicamento = Http::get("http://localhost:3000/medicamentos/{$cod}")->object();
        var_dump($medicamento);
        return redirect()->route("productos", compact('medicamento', 'open'));
    }

























    public function ShowInventario(){

        return view("/almacen/inflecto");
    }

    
}
