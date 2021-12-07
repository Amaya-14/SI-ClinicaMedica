<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersona extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identidad' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'nacionalidad' => 'required',
            'edad' => 'required|digits:3',
            'fechaNacimiento' => 'required',
            'sexo' => 'required',
            'estadoCivil' => 'required',
            'tipo' => 'required',

            'numArea' => 'required',
            'numTelefono' => 'required',
            'tipoTelefono' => 'required',
            'desTelefono' => '',

            'direccion' => 'required',
            'desDireccion' => '',

            'correo' => 'required',

            'cargo' => 'required',
            'foto' => '',
            'fechaContratacion' => 'required',
        ];
    }

    public function attribute(){
        return [
            'fechaNacimiento' => 'fecha de nacimiento',
            'estadoCivil' => 'estado civil',
            'numArea' => 'número de area',
            'numTelefono' => 'número de teléfono',
            'tipoTelefono' => 'tipo de teléfono',
            'fechaContratacion' => 'fecha de contratación'

        ];
    }

    public function message(){
        return [
            'edad.max' => 'El campo no debe de exceder los 3 dígitos'
        ];
    }
}
