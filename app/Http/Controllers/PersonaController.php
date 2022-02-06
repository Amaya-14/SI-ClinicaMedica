<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

/* Validaciones */
use App\Http\Request\CreatePersona;

class PersonaController extends Controller
{

    public function ShowPersona(){
        $heads = [
            '#',
            'Identidad',
            'Nombre',
            'Nacionalidad',
            'Edad',
            ['label' => 'Fecha de Nacimiento', 'no-export' => false, 'width' => 15],
            'Sexo',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 10],
        ];

        $API = config('constants.HOST_API');

        $responses = Http::pool(fn (Pool $pool) => [
            $pool->as('pacientes')->get("{$API}/pacientes"),
            $pool->as('empleados')->get("{$API}/empleados"),
            $pool->as('cargos')->get("{$API}/cargos"),
        ]);
        
        return view("personas/registros", compact('heads', 'responses') );
    }

    public function ShowDetalle($vista, $id){
        $heads = [
            'Area',
            'Telefono',
            'Tipo',
            'Descripción',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $heads2 = [
            'Dirección',
            'Descripción',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $heads3 = [
            'Correo',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];

        $API = config('constants.HOST_API');

        $data = Http::get("{$API}/{$vista}/$id")->object();

        $data[0]->fecha = substr($data[0]->fecha, 0, 10);
        $cod = $data[0]->codigoP;

        if ($vista == 'paciente'){
            $vista = 'detallePaciente';
        }else{
            $vista = 'detalleEmpleado';
            $data[0]->fechaContratacion = substr($data[0]->fechaContratacion, 0, 10);
        } 

        $data2 = Http::get("{$API}/telefonos/$cod")->object();
        $data3 = Http::get("{$API}/direcciones/$cod")->object();
        $data4 = Http::get("{$API}/correos/$cod")->object();
        $data5 = Http::get("{$API}/cargos")->object();
        $count = 0;

        return view("personas/{$vista}", compact('data','data2','data3','data4', 'data5','count', 'heads', 'heads2', 'heads3'));
    }

    public function GetRegistro($str, $cod){
        $API = config('constants.HOST_API');
        switch ($str) {
            case 'telefono':
                $data = Http::get("{$API}/telefono/$cod");
                break;
            case 'direccion':
                $data = Http::get("{$API}/direccion/$cod");
                break;
            case 'correo':
                $data = Http::get("{$API}/correo/$cod");
                break;
            default:
                $data = [[]];
                break;
        }
        return response()->json($data[0]);
    }

    public function CreatePersona(Request $request){
        $API = config('constants.HOST_API');
        $response = Http::post('{$API}/persona', [
            'identidad' => $request->identidad,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'nacionalidad' => $request->nacionalidad,
            'edad' => $request->edad,
            'fechaNacimiento' => $request->fechaNacimiento,
            'sexo' => $request->sexo,
            'estadoCivil' => $request->estadoCivil,
            'tipo' => $request->tipRegistro,

            'numArea' => $request->numArea,
            'numTelefono' => $request->numTelefono,
            'tipoTelefono' => $request->tipoTelefono,
            'desTelefono' => is_null($request->desTelefono) ? '---' : $request->desTelefono,

            'direccion' => $request->direccion,
            'desDireccion' => is_null($request->desDireccion) ? '---' : $request->desDireccion,

            'correo' => $request->correo,

            'cargo' => is_null($request->cargo) ? 'P' : $request->cargo,
            'foto' => is_null($request->foto) ? '---' : $request->foto,
            'fechaContratacion' => is_null($request->fechaContratacion) ? '01/01/2022' : $request->fechaContratacion,
        ]);

        $message = ($response->successful()) ? 'ok' : 'error';
        
        //return redirect(url()->previous())->with('create', $message);
        return redirect()->route("mostrarPersonas")->with('create', $message);
    }

    /*Editar un registro*/
    public function UpadatePersona(Request $request, $str){
        $API = config('constants.HOST_API');   
        if ($str == 'paciente') {;
            $registro = 'P';
            $cargo = '0';
            $foto = '----';
            $fechaContratacion = "00/00/0000";
        }

        if ($str == 'empleado') {
            $registro = 'E';
            $cargo = $request->cargo;
            $foto = is_null($request->foto) ? '---' : $request->foto;
            $fechaContratacion = $request->fechaContratacion;
        }
        
        $response = Http::put("{$API}/persona/$request->codigo", [
            'identidad' => $request->identidad,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'nacionalidad' => $request->nacionalidad,
            'edad' => $request->edad,
            'fechaNacimiento' => $request->fechaNacimiento,
            'sexo' => $request->sexo,
            'estadoCivil' => $request->estadoCivil,
            'registro' => $registro,

            'cargo' => $cargo,
            'foto' => $foto,
            'fechaContratacion' => $fechaContratacion,
        ]);
        
        $message = ($response->successful()) ? 'ok' : 'error';
        
        return redirect(url()->previous())->with('update', $message);
    }

    public function UpdateRegistros(Request $request, $str){
        $API = config('constants.HOST_API');
        switch ($str) {
            case 'telefonos':
                $response = Http::put("{$API}/telefono/$request->codigo", [
                    'numArea' => $request->numArea,
                    'numTelefono' => $request->numTelefono,
                    'tipoTelefono' => $request->tipoTelefono,
                    'desTelefono' => $request->desTelefono,
                ]);
                break;

            case 'direcciones':
                /*var_dump($request->codigo);
                var_dump($request->direccion);
                var_dump($request->desDireccion);*/
                $response = Http::put("{$API}/direccion/$request->codigo", [
                    'direccion' => $request->direccion,
                    'desDireccion' => $request->desDireccion,
                ]);
                break;

            case 'correos':
                $response = Http::put("{$API}/correos/$request->codigo", [
                    'corr' => $request->correo,
                ]);
                break;
            default:
                # code...
                break;
        }

        $message = ($response->successful()) ? 'ok' : 'error';
        
        return redirect(url()->previous())->with('update', $message);
        //return redirect()->route("detallePersona", $request->persona)->with('update','ok');
    }

    /*Eliminar un registro*/
    public function DeletePersona($str, $cod){
        $API = config('constants.HOST_API');
        switch ($str) {
            case 'pacientes':
                $response = Http::delete("{$API}/paciente/$cod");
                break;
            case 'empleados':
                $response = Http::delete("{$API}/empleado/$cod");
                break;
            default:
                # code...
                break;
        }

        $message = ($response->successful()) ? 'ok' : 'error';
        return redirect(url()->previous())->with('delete', $message);
        //return redirect()->route("mostrarPersonas")->with('delete', 'ok');
    }

    public function DeleteRegistro($str, $cod, $p){
        $API = config('constants.HOST_API');
        switch ($str) {
            case 'telefonos':
                $response = Http::delete("{$API}/telefono/$cod");
                break;
            case 'direcciones':
                $response = Http::delete("{$API}/direccion/$cod");
                break;
            case 'correos':
                $response = Http::delete("{$API}/correo/$cod");
                break;
            default:
                # code...
                break;
        }

        $message = ($response->successful()) ? 'ok' : 'error';
        
        return redirect(url()->previous())->with('delete', $message);
        //return redirect()->route("detallePersona", $p)->with('delete','ok');
    }
}
