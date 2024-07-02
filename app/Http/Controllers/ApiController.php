<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Rules;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class ApiController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'type' => ['required']
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->tipo = $request->type;
        $user->password = Hash::make($request->string('password'));

        $user->save();


        return response()->json(["status"=>200,"message"=>"Usuario criado com sucesso"]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device'=>'required'
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(["message"=>"Credencias invalidas"],401) ;
        }
    
        $user->tokens()->delete();
        $token = $user->createToken($request->device)->plainTextToken;

        $camposUser = $user->only(['name', 'email', 'tipo']);

        return response()->json(["token"=>$token,"type"=>"Bearer","data"=>["usuario"=>$camposUser]]) ;
    }

    public function create_rule(Request $request)
{
    // Validar o token
    $token = $request->bearerToken(); 
    if (!$token) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $personalAccessToken = PersonalAccessToken::findToken($token);

    if (!$personalAccessToken) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Definir regras de validação
    $rules = [
        'user_id' => 'required|exists:users,id',
        'banco_id' => 'required|exists:bancos,id',
        'limite' => 'required|numeric',
    ];

    $messages = [
        'user_id.required' => 'O campo usuário é obrigatório.',
        'user_id.exists' => 'O usuário selecionado é inválido.',
        'banco_id.required' => 'O campo banco é obrigatório.',
        'banco_id.exists' => 'O banco selecionado é inválido.',
        'limite.required' => 'O campo limite é obrigatório.',
        'limite.numeric' => 'O campo limite deve ser um número.',
    ];

    try {
        // Validar a solicitação
        $validatedData = $request->validate($rules, $messages);

        // Verificar se a regra já existe
        $rule = Rules::where('user_id', $validatedData['user_id'])
                     ->where('banco_id', $validatedData['banco_id'])
                     ->first();

        if ($rule) {
            // Atualizar a regra existente
            $rule->limite = $validatedData['limite'];
            $rule->save();

            return response()->json(["message" => "Regra atualizada com sucesso"], 200);
        } else {
            // Criar uma nova regra
            Rules::create($validatedData);

            return response()->json(["message" => "Regra criada com sucesso"], 200);
        }
    } catch (ValidationException $e) {
        return response()->json([
            "message" => "Erro de validação",
            "errors" => $e->errors()
        ], 400);
    }
}

    public function users_rule(Request $request){

        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rules = [
            'user_id' => 'required|exists:users,id',
        ];

        $messages = [
            'user_id.required' => 'O campo usuário é obrigatório.',
            'user_id.exists' => 'O usuário selecionado é inválido.',
        ];

        try {
            $request->validate($rules, $messages);

            $rules = Rules::with('user', 'banco')->where('user_id',$request->user_id)->get();

            $formattedRules = $rules->map(function ($rule) {
                return [
                    'id' => $rule->id,
                    'user_id' => $rule->user_id,
                    'email' => $rule->user->email,
                    'banco_id' => $rule->banco_id,
                    'banco_name' => $rule->banco->nome,
                    'limite' => $rule->limite,
                    'created_at' => $rule->created_at->toISOString(),
                    'updated_at' => $rule->updated_at->toISOString(),
                ];
            });
        
            return response()->json([
                'status' => 200,
                'data' => $formattedRules,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Erro de validação",
                "errors" => $e->errors()
            ], 400);
        }
    }

    public function create_banco(Request $request){

        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rules = [
            'nome' => 'required',
        ];

        $messages = [
            'nome' => 'O campo nome é obrigatório.',
        ];

        try {
            $request->validate($rules, $messages);

            Bancos::create($request->all());

            return response()->json(["message" => "Banco criado com sucesso"], 200);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Erro de validação",
                "errors" => $e->errors()
            ], 400);
        }
    }

    public function bancos(Request $request){

        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $bancos = Bancos::get();

        if($bancos){
            return response()->json(["bancos"=>$bancos],200);
        }
    }


}
