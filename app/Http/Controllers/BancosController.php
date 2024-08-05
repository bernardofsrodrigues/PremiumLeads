<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campanhas;

class BancosController extends Controller
{
    public function obterBancos()
    {
        $bancos = Campanhas::with(['user', 'bancos'])->get();
        foreach ($bancos as $campanha) {
            dd($campanha->bancos(), $campanha->user());
        }
        return view('site.controle_bancos', compact('bancos'));
    }
}
