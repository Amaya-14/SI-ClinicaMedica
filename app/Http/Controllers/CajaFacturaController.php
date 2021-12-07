<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CajaFacturaController extends Controller
{
    public function ShowCaja(){

        /*Registro*/

        /* Caja Chica */
        $heads1 = [
            'Código',
            'Fecha',
            'Tipo',
            'Cantidad',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $data1 = DB::select("CALL sp_select_cajaANDfactura('movimientos',0);");

        /* Cajas Registradoras*/
        $heads2 = [
            'Código',
            'Nombre',
            'Descripción',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $data2 = DB::select("CALL sp_select_cajaANDfactura('cajas',0);");

        /* Factura*/

        return view('/caja/cajaChica', compact('heads1', 'data1', 'heads2', 'data2'));
    }
}
