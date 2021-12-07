<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/* Validaciones */
use App\Http\Request\CreatePersona;

class PersonaController extends Controller
{

    public function ShowPersona($vista){
        $heads = [
            'Código',
            'Identidad',
            'Nombre',
            'Nacionalidad',
            'Edad',
            ['label' => 'Fecha de Nacimiento', 'no-export' => true, 'width' => 15],
            'Sexo',
            'Estado Civil',
            ['label' => 'Opciones', 'no-export' => true, 'width' => 15],
        ];
        
        $data = Http::get("http://localhost:3000/{$vista}")->object();

        return view("personas/{$vista}", compact('heads', 'data') );
    }

    public function ShowDetalle($id){
        $data = Http::get("http://localhost:3000/paciente/$id")->object();

        $data[0]->fecha = substr($data[0]->fecha, 0, 10);
        $cod = $data[0]->codp;

        $data2 = Http::get("http://localhost:3000/telefonos/$cod")->object();
        $data3 = Http::get("http://localhost:3000/direcciones/$cod")->object();
        $data4 = Http::get("http://localhost:3000/correos/$cod")->object();

        return view("personas/detallePaciente", compact('data','data2','data3','data4'));
    }

    public function CreatePersona(CreatePersona $request, $vista){

        if ($vista == 'pacientes') {
            $tipo = 'P';
            $cargo = '0';
            $foto = '----';
            $fechaContratacion = "00/00/0000";
        }

        if ($vista == 'empleados') {
            $tipo = 'E';
            $cargo = $request->cargo;
            $foto = $request->foto;
            $fechaContratacion = $request->fechaContratacion;
        }

        Http::post('http://localhost:3000/persona', [
            'identidad' => $request->identidad,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'nacionalidad' => $request->nacionalidad,
            'edad' => $request->edad,
            'fechaNacimiento' => $request->fechaNacimiento,
            'sexo' => $request->sexo,
            'estadoCivil' => $request->estadoCivil,
            'tipo' => $tipo,

            'numArea' => $request->numArea,
            'numTelefono' => $request->numTelefono,
            'tipoTelefono' => $request->tipoTelefono,
            'desTelefono' => $request->desTelefono,

            'direccion' => $request->direccion,
            'desDireccion' => $request->desDireccion,

            'correo' => $request->correo,

            'cargo' => $cargo,
            'foto' => $foto,
            'fechaContratacion' => $fechaContratacion,
        ]);

        return redirect()->route("registros", $vista);
    }

    /*Editar un registro*/
    public function UpadatePersona(Request $request, $cod, $str){

        if ($str == 'datos') {
            Http::put('http://localhost:3000/persona/$cod', [
                'identidad' => $request->identidad,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'nacionalidad' => $request->nacionalidad,
                'edad' => $request->edad,
                'fechaNacimiento' => $request->fechaNacimiento,
                'sexo' => $request->sexo,
                'estadoCivil' => $request->estadoCivil,
                'tipo' => $tipo,

                'cargo' => $cargo,
                'foto' => $foto,
                'fechaContratacion' => $fechaContratacion,
            ]);
        }
                
        if ($str == 'telefono') {
            /*for ($i=0; $i< ($request.length / 4); $i++) { 
                Http::put('http://localhost:3000/telefono/$cod', [
                    'numArea' => $request->numArea,
                    'numTelefono' => $request->numTelefono,
                    'tipoTelefono' => $request->tipoTelefono,
                    'desTelefono' => $request->desTelefono,
                ]);            
            }*/

            echo $request;
        }
        
        if ($str == 'direccion') {
            for ($i=0; $i< ($request.length / 2); $i++) { 
                Http::put('http://localhost:3000/direccion/$cod', [
                    'direccion' => $request->direccion,
                    'desDireccion' => $request->desDireccion,
                ]);            
            }    
        }
        
        if ($str == 'correo') {
            for ($i=0; $i< $request.length; $i++) { 
                Http::put('http://localhost:3000/correo/$cod', [
                    'correo' => $request->correo,
                ]);            
            }
        }
    }

    /*Eliminar un registro*/
    public function DeletePersona(){

    }

}
