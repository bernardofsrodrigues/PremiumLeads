<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function controleUsuarios()
    {
        $usuarios = User::all();
        return view('site.controle_usuarios', ["usuarios" => $usuarios]);
    }

    public function alterarSituacao(Request $request)
    {
        if (Auth::user()->tipo == "admin") {
            $user = User::find($request->user_id);

            if ($user) {
                $user->active = !$user->active; // Alterna o status
                $user->save();
            }
        }

        return redirect()->back();
    }   

}
