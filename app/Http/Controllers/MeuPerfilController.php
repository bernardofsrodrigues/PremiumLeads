<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuPerfilController extends Controller
{
    public function index()
    {
        return view('site.editar_perfil');
    }
}
