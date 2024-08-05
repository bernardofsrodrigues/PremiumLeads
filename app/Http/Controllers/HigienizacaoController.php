<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Higienizacao;
use App\Models\Bancos;

class HigienizacaoController extends Controller
{
    public function paginaBancos(string $banco, string $produto, int $id)
    {
        return view("site.layouts.formato_bases", compact('banco', 'produto', 'id'));
    }

    public function adicionarBase(string $banco, string $produto, int $id, Request $request) {
        $rules = [
            'nome' => 'required',
            'arquivo' => 'required|file|mimes:csv,txt'            
        ];

        $mensagens = [
            'required' => 'O campo :attribute não foi preenchido',
            'arquivo.file' => 'Deve ser um arquivo do tipo .csv ou .txt',
            'arquivo.mimes' => 'Deve ser um arquivo do tipo .csv ou .txt'
        ];

        $validatedData = $request->validate($rules, $mensagens);

        $novaBase = new Higienizacao();
        $novaBase->nome = $validatedData['nome'];
        $novaBase->banco = $banco;
        $novaBase->arquivo = $request->file('arquivo')->store('arquivos');

        $novaBase->save();
        
        return redirect('site.layouts.formato_bases')->with('success', 'Base adicionada com sucesso!');
    }
}
