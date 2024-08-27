<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campanhas;
use App\Models\User;


class CampanhasController extends Controller
{
    public function controleBases()
    {
        $campanhas = Campanhas::with('user', 'bancos')->get();
        return view('site.controle_bases', ["campanhas" => $campanhas]);
    }

    public function adicionarCampanha(Request $request) {
        $bases = Campanhas::find($request->nome);
        
        return redirect()->back();
    }
}
