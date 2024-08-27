<?php

namespace App;

use App\Models\Campanha;
use Illuminate\Support\Facades\DB;

class AcaosCampanhas
{
    public function att_painel_campanha($uuid){
        $registrosProcessados = DB::table($uuid)
        ->where('sit', '<>', 0)
        ->count();

        $campanhas = Campanha::where('uuid_tabela',$uuid)->first();
        if($campanhas){
            $campanhas->processados = $registrosProcessados;
            $campanhas->save();
            
        }

    }
}
