<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function ShowPersona($vista){
        
        return view("personas/{$vista}");
    }
}
