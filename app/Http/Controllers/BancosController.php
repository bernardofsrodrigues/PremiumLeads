<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bancos;

class BancosController extends Controller
{
    public function obterBancos()
    {
        $bancos = Bancos::get();
        // foreach ($bancos as $campanha) {
        //     dd($campanha->bancos(), $campanha->user());
        // }
        return view('site.controle_bancos', compact('bancos'));
    }

    public function deletarBanco(int $banco_id)
    {
        $banco = Bancos::find($banco_id);

        if ($banco) {
            $banco->active = !$banco->active;
            $banco->save();
        }

        return redirect()->route('controle_bancos.view');
    }

    public function adicionarBanco(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
        ]);

        Bancos::create([
            'nome' => $request->input('name'),
            'active' => true,
        ]);

        return redirect()->route('controle_bancos.view');
    }
}
