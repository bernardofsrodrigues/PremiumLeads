<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campanhas;
use App\Models\User;

class CampanhasRController extends Controller
{
    public function campanhas(Request $request){
        // $campanhas = Campanhas::where('user_id',$request->user)->where('banco_id',$request->banco)->where('sit_campanha',1)->get();
        // dd($request->user, $request->banco);
        // if($campanhas->isNotEmpty()){
        //     $response = 200;
        //     return view('site.campanhas', ['campanhas' => $campanhas, 'response' => $response]);
        //     //->response()->json($campanhas, 200);
        // }else{
        //     $response = "Sem bases processando";
        //     return view('site.campanhas', ['campanhas' => $campanhas, 'response' => $response]);
        //     // return response()->json(['message' => 'Nenhuma campanha foi localizada'], 400);
        // }
        $campanhas = Campanhas::with('user', 'bancos')->where('sit_campanha',1)->get();
        $response = "teste"; //aqui to só fazendo uns testes
        return view('site.campanhas', ["campanhas" => $campanhas, 'response' => $response]);
    }

    // public function status_campanha(Request $request){
    //     $campanhas = Campanhas::where('uuid_tabela', $request->uuid_tabela)->first();
        
    //     if (!$campanhas) {
    //         return response()->json(['message' => 'Campanha não foi localizada'], 400);
    //     }
        
    //     if (!$request->has('sit') || $request->sit === null) {
    //         return response()->json(['message' => 'O campo sit_campanha é obrigatório'], 400);
    //     }
        
    //     $campanhas->sit_campanha = $request->sit;
    //     $campanhas->updated_at = now();
    //     $campanhas->save();
    
    //     return response()->json(['message' => 'Campanha atualizada com sucesso'], 200);
    // }
    
    
    public function campanhas_pendente(Request $request){
        $results = DB::table($request->tabela)
        ->select('cpf', 'nasc')
        ->whereNull('sit')
        ->inRandomOrder() // Ordenação aleatória
        ->first();
        if($results){
            return response()->json($results, 200);
        } else {
            return response()->json(['message' => 'Nenhum registro localizado'], 400);
        };
        
    }
    
    public function update_cliente_tabela(Request $request){
        $updated = DB::table($request->tabela)->where('cpf', $request->cpf)->update([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'saldo' => $request->saldo,
            'saldo_lib' => $request->saldo_lib,
            'sit' => $request->sit,
            'detalhes' => $request->log,
            'dt_consulta' => $request->dt,
        ]);
        if ($updated) {
            $acaoCampanhas = new AcaosCampanhas();
            $acaoCampanhas->att_painel_campanha($request->tabela);
            return response()->json(['message' => 'Registro atualizado com sucesso'], 200);
        } else {
            return response()->json(['message' => 'Nenhum registro atualizado'], 404);
        };
    }
}
