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
        /*
        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $usuario = User::getUser($personalAccessToken->id);

        if($usuario->tipo != "admin"){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        */

        // Define as regras de validação
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'type' => ['required']
        ];

        // Define as mensagens de validação personalizadas
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.lowercase' => 'O campo email deve estar em letras minúsculas.',
            'email.email' => 'O campo deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres.',
            'email.unique' => 'O email fornecido já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'type.required' => 'O campo tipo é obrigatório.',
        ];

        try {
            // Valida os dados da requisição
            $validatedData = $request->validate($rules, $messages);

            // Cria o novo usuário
            $user = new User;
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->tipo = $validatedData['type'];
            $user->password = Hash::make($validatedData['password']);

            // Salva o usuário no banco de dados
            $user->save();

            // Retorna uma resposta de sucesso
            return response()->json(["status" => 200, "message" => "Usuário criado com sucesso."], 200);

        } catch (ValidationException $e) {
            // Retorna uma resposta de erro de validação
            return response()->json([
                "message" => "Erro de validação",
                "errors" => $e->errors()
            ], 400);
        }
    }

    public function login(Request $request){
        // Define as regras de validação
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'device' => 'required'
        ];

        // Define as mensagens de validação personalizadas
        $messages = [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo deve ser um endereço de e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'device.required' => 'O campo dispositivo é obrigatório.'
        ];

        try {
            // Valida os dados da requisição
            $validatedData = $request->validate($rules, $messages);

            // Busca o usuário pelo email
            $user = User::where('email', $validatedData['email'])->first();

            // Verifica se o usuário existe e se a senha está correta
            if (!$user || !Hash::check($validatedData['password'], $user->password)) {
                return response()->json([
                    "message" => "Credenciais inválidas"
                ], 401);
            }

            // Remove todos os tokens existentes do usuário
            $user->tokens()->delete();

            // Cria um novo token para o dispositivo fornecido
            $token = $user->createToken($validatedData['device'])->plainTextToken;

            // Prepara os dados do usuário para a resposta
            $camposUser = $user->only(['name', 'email', 'tipo']);

            // Retorna a resposta com o token e dados do usuário
            return response()->json([
                "token" => $token,
                "type" => "Bearer",
                "data" => ["usuario" => $camposUser]
            ]);

        } catch (ValidationException $e) {
            // Retorna uma resposta de erro de validação
            return response()->json([
                "message" => "Erro de validação",
                "errors" => $e->errors()
            ], 400);
        }
    }

    public function me(Request $request) {
        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $usuario = User::getUser($personalAccessToken->id);
        return response()->json($usuario);
    }

    public function alterar_perfil(Request $request){

        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $usuario = User::getUser($personalAccessToken->id);

        if($usuario->tipo != "admin"){
            $request->merge(['user_id' => $usuario->id]);
        }

        $rules = [
            'user_id' => 'required|exists:users,id',
            'email' => 'required|email|min:5',
            'nome' => 'required|string|min:4',
        ];

        $messages = [
            'user_id.required' => 'O campo usuário é obrigatório.',
            'user_id.exists' => 'O usuário selecionado é inválido.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo deve ser um endereço de e-mail válido.',
            'email.min' => ' O campo deve ter mais de 5 caracter.',
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => ' O campo deve ser uma string.',
            'nome.min' => ' O campo deve ter mais de 4 caracter.',
        ];

        try {

            $validatedData = $request->validate($rules, $messages);

            $user = User::where('id',$validatedData['user_id'])->first();

            if($user){
                $user->email = $validatedData['email'];
                $user->name = $validatedData['nome'];

                $user->save();

                return response()->json(["status"=>200,"message"=>"Usuario atualizado com sucesso."],200);
            }

            return response()->json(["status"=>400,"message"=>"Usuario não localizado."],400);

        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Erro de validação",
                "errors" => $e->errors()
            ], 400);
        }
        
    }

    public function create_rule(Request $request){
        // Validar o token
        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $usuario = User::getUser($personalAccessToken->id);

        if($usuario->tipo != "admin"){
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

        $usuario = User::getUser($personalAccessToken->id);

        if($usuario->tipo != "admin"){
            $request->merge(['user_id' => $usuario->id]);
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

        $usuario = User::getUser($personalAccessToken->id);

        if($usuario->tipo != "admin"){
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

        $usuario = User::getUser($personalAccessToken->id);

        if($usuario->tipo != "admin"){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $bancos = Bancos::get();

        if($bancos){
            return response()->json(["bancos"=>$bancos],200);
        }
    }



}
