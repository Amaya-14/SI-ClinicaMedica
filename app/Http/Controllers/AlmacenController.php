<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlmacenController extends Controller
{
    public function ShowProductos(){

        $heads1 = [
            '#',
            'Nombre',
            'Presentación',
            'Tipo',
            ['label' => 'OPCIONES', 'no-export' => true, 'width' => 15],
        ];

        $medicamentos = Http::get("http://localhost:3000/medicamentos")->object();
        $presentaciones = Http::get("http://localhost:3000/upresentacion")->object();
        $tipoMedicamentos = Http::get("http://localhost:3000/tipmedicamentos")->object();
        $count1 = 1;

        $heads2 = [
            '#',
            'Nombre',
            'Tipo',
            'Descipción',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $materiales = Http::get("http://localhost:3000/materiales")->object();
        $tipoMateriales = Http::get("http://localhost:3000/tipmaterial")->object();
        $count2 = 1;

        return view("/almacen/productos", compact('heads1', 'medicamentos', 'presentaciones', 'tipoMedicamentos', 'count1','heads2', 'materiales', 'tipoMateriales', 'count2'));
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

    public function UpdateProducto(Request $request, $str){

        if($str == 'medicamentos'){
            Http::put("http://localhost:3000/medicamentos/$request->codigoMe", [
                'nombre' => $request->nombre,
                'presentacion' => $request->presentacion,
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
            ]);
        }

        if($str == 'materiales'){
            Http::put("http://localhost:3000/materiales/$request->codigoMa", [
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
            ]);
        }

            return redirect()->route('productos');
    }

    public function DeleteProducto($str, $cod){

        Http::delete("http://localhost:3000/almacen/$str/$cod");

        return redirect()->route('productos')->with('eliminar', 'ok');
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

























    public function ShowInventario(){

        return view("/almacen/inflecto");
    }

    
}
