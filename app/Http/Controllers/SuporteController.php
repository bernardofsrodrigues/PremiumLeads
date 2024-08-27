<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuporteController extends Controller
{
    public function index()
    {
        return view('site.suporte');
    }

    public function enviarMensagem(Request $request)
    {
        $rules = [
            'mensagem' => 'required'
        ];

        $feedback = [
            'required' => 'O campo mensagem não deve estar vazio.'
        ];

        $request->validate($rules, $feedback);

        $mensagem = $request->input('mensagem');

        //criar tabela para receber mensagens e enviar para conta dos meninos do suporte
    }
}
