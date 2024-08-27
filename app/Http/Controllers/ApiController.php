<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Campanhas;
use App\Models\Logs_atividades;
use App\Models\Rules;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Support\Facades\Storage;
use App\AcaosCampanhas;

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

        $usuario = User::getUser($personalAccessToken->tokenable_id);

        if($usuario->tipo != "admin"){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        */

        // Define as regras de validação
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'repassword'=>['required'],
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
            'repassword.required' => 'O campo repitir senha é obrigatório.',
            'type.required' => 'O campo tipo é obrigatório.',
        ];

        try {
            // Valida os dados da requisição
            $validatedData = $request->validate($rules, $messages);

            if ($validatedData['password'] != $validatedData['repassword']){
                return response()->json([
                    "message" => "As senhas não são iguais.",
                ], 400);
            }

            // Cria o novo usuário
            $user = new User;
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->tipo = $validatedData['type'];
            $user->password = Hash::make($validatedData['password']);

            // Salva o usuário no banco de dados
            $user->save();

            // Retorna uma resposta de sucesso
            //return response()->json(["status" => 200, "message" => "Usuário criado com sucesso."], 200);
            return redirect()->back()->with(['success' => 'Usuário criado com sucesso.']);

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
                return redirect()->back()->withInput()->with('error', 'Credenciais inválidas.');
            }

            if ($user->active != true){
                return redirect()->back()->withInput()->with('error', 'Usuário desabilitado ou bloqueado.');
            }

            // Remove todos os tokens existentes do usuário
            $user->tokens()->delete();

            // Cria um novo token para o dispositivo fornecido
            $token = $user->createToken($validatedData['device'])->plainTextToken;

            $user->updated_at = now();

            $user->save();

            // Prepara os dados do usuário para a resposta
            $camposUser = $user->only(['name', 'email', 'tipo']);

            if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
                return redirect(route('principal.view'));
            } else {
                return redirect()->back()->withInput()->with('error', 'Credenciais inválidas.');;
            }

            return redirect(route('principal.view'));

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
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

        $usuario = User::getUser($personalAccessToken->tokenable_id);
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

        $usuario = User::getUser($personalAccessToken->tokenable_id);

        if($usuario->tipo != "admin"){
            $request->merge(['user_id' => $usuario->id]);
        }

        $rules = [
            'user_id' => 'required|exists:users,id',
            'email' => 'required|email|min:5',
            'nome' => 'required|string|min:4',
            'ativo' => 'required|boolean',

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
            'ativo.required' => 'O campo ativo é obrigatório.',
            'ativo.boolean' => 'O campo deve ser uma boolean.',

        ];

        try {

            $validatedData = $request->validate($rules, $messages);

            $user = User::where('id',$validatedData['user_id'])->first();

            if (!$validatedData['ativo']){
                $user->tokens()->delete();
            }

            if($user){
                $user->email = $validatedData['email'];
                $user->name = $validatedData['nome'];
                $user->active = $validatedData['ativo'];
                $user->updated_at = now();

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

        $usuario = User::getUser($personalAccessToken->tokenable_id);

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

        $usuario = User::getUser($personalAccessToken->tokenable_id);

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

        $usuario = User::getUser($personalAccessToken->tokenable_id);

        if($usuario->tipo != "admin"){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rules = [
            'nome' => 'required|unique:Bancos',
        ];

        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Esse banco já foi criado.',
        ];

        try {
            $request->validate($rules, $messages);

            Bancos::create($request->all());

            Logs_atividades::CreatedLog($usuario->id,200,"Banco criado com sucesso");

            return response()->json(["message" => "Banco criado com sucesso"], 200);
        } catch (ValidationException $e) {

            $errorsString = implode('; ', array_map(function ($error) {
                return implode(', ', $error);
            }, $e->errors()));

            Logs_atividades::CreatedLog($usuario->id,400,$errorsString);

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

        $usuario = User::getUser($personalAccessToken->tokenable_id);

        if($usuario->tipo != "admin"){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $bancos = Bancos::get();

        if($bancos){
            return response()->json(["bancos"=>$bancos],200);
        }
    }

    public function users(Request $request){

        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $usuario = User::getUser($personalAccessToken->tokenable_id);

        if($usuario->tipo != "admin"){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $users = User::get();

        if($users){
            return response()->json(["usuarios"=>$users],200);
        }
    }

    public function create_log(Request $request){
        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $usuario = User::getUser($personalAccessToken->tokenable_id);

        $rules = [
            'status' => 'required|integer',
            'message' => 'required|string',
        ];

        $messages = [
            'status.required' => 'O campo status é obrigatório.',
            'status.integer' => 'O campo status deve ser inteiro.',
            'message.required' => 'O campo message é obrigatório.',
            'message.string' => 'O campo status deve ser texto.',
        ];

        try {
            $request->validate($rules, $messages);

            return Logs_atividades::CreatedLog($usuario->id,$request->status,$request->message);

        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Erro de validação",
                "errors" => $e->errors()
            ], 400);
        }

    }

    public function logs(Request $request){

        $token = $request->bearerToken(); 
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $usuario = User::getUser($personalAccessToken->tokenable_id);

        $logs = Logs_atividades::where('user_id',$usuario->id)->get();

        if($logs){
            return response()->json(["data"=>$logs],200);
        }
    }

    private function getMissingHeaders(array $header, array $expectedHeader): array
    {
        return array_diff($expectedHeader, $header);
    }

    private function importCsvToTemporaryTable(string $filePath,string $cod_tabela)
    {
        try {
            $path = str_replace('\\', '/', $filePath);
            DB::statement("CREATE TABLE IF NOT EXISTS dbtemp_$cod_tabela (
                cpf VARCHAR(20),
                nasc VARCHAR(30),
                nome VARCHAR(255),
                telefone VARCHAR(30),
                var1 VARCHAR(50),
                var2 VARCHAR(50),
                var3 VARCHAR(50),
                saldo VARCHAR(30),
                saldo_lib VARCHAR(30),
                sit INT,
                fila INT,
                detalhes VARCHAR(255),
                dt_consulta VARCHAR(30),
                INDEX index_sit (sit)
            )");
            
            DB::statement("LOAD DATA LOCAL INFILE '$path' INTO TABLE dbtemp_$cod_tabela FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' IGNORE 1 LINES(cpf, nasc, nome, telefone,var1,var2,var3)");
            
            $count = DB::table('dbtemp_'.$cod_tabela)->count();

            return $count;
            
        } catch (\Exception $e) {
            // Captura e retorna a mensagem de erro
            return $e->getMessage();
        }
    }

    public function create_campanha(string $banco, string $produto, int $id, Request $request){
        $bancos = Bancos::create($request->all());

        $rules = [
            'nome' => 'required',
            'banco_id' => 'required|exists:bancos,id',
            'arquivo' => 'required|file|mimes:csv,txt|max:40960'
        ];

        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'banco_id.required' => 'O campo banco é obrigatório.',
            'banco_id.exists' => 'O Banco informado não existe.',
            'arquivo.required' => 'O campo arquivo é obrigatório.',
            'arquivo.file' => 'O campo arquivo deve ser enviado um arquivo csv,txt.',
            'arquivo.mimes' => 'Suporte apenas para .csv e .txt .',
            'arquivo.max' => 'Tamanho maximo do arquivo deve ser 40 MB.',
        ];
        $cod_tabela = now()->format('dmYHis');
        $usuario = Auth::user();
        try {
            

            $file = $request->file('arquivo');
            $path = $file->storeAs('csv', $cod_tabela.'.csv', 'local');
            $fullPath = storage_path('app/' . $path);

            $csv = Reader::createFromPath($fullPath, 'r');
            $csv->setDelimiter(';');
            $csv->setHeaderOffset(0);

            $header = $csv->getHeader();

            $expectedHeader = ['cpf', 'nasc', 'nome','telefone','var1','var2','var3'];
            $missingHeaders = $this->getMissingHeaders($header, $expectedHeader);

            if (!empty($missingHeaders)) {
                Logs_atividades::CreatedLog($usuario->id,500,'Cabeçalho do CSV invalido. Não localizado: ' . implode(', ', $missingHeaders));
                return response()->json(['error' => " Cabeçalho do CSV invalido. Não localizado: " . implode(', ', $missingHeaders)]);
            }

            $result = $this->importCsvToTemporaryTable($fullPath,$cod_tabela);

            if (is_numeric($result)) {

                $campanha = new Campanhas;

                $campanha->banco_id = $id;

                $campanha->user_id = $usuario->id;
                $campanha->nome = $request->nome;
                $campanha->uuid_tabela = $cod_tabela;
                $campanha->registros = $result;
                $request->validate($rules, $messages);
                $campanha->save();

                Logs_atividades::CreatedLog($usuario->id,200,"Nova campanha `$request->nome` criada com sucesso.");
                Logs_atividades::CreatedLog($usuario->id,200,"$result clientes adicionado na campanha `$request->nome`");
                
                return redirect()->back()->with('status', 'Campanha criada com sucesso.');
            } else {
                return response()->json(["status"=>400,"message"=>$result],400);
                Logs_atividades::CreatedLog($usuario->id,400,"Não foi possivel criar sua campanha, Errors: $result");
            }

        } catch (ValidationException $e) {

            return response()->json([
                "message" => "Erro de validação",
                "errors" => $e->errors()
            ], 400);
        }


    }


    
    public function campanhas(Request $request){
        $campanhas = Campanha::where('id_usuario',$request->user)->where('banco',$request->banco)->where('sit_campanha',1)->get();
        if($campanhas->isNotEmpty()){
            return response()->json($campanhas, 200);
        }else{
            return response()->json(['message' => 'Nenhuma campanha foi localizada'], 400);
        }
    }
    
    public function status_campanha(Request $request){
        $campanhas = Campanha::where('uuid_tabela',$request->uuid_tabela)->first();
        if ($campanhas) {
            $campanhas->sit_campanha = $request->sit;
            $campanhas->updated_at = now();
            $campanhas->save();
    
            return response()->json(['message' => 'Campanha atualizada com sucesso'], 200);
        } else {
            return response()->json(['message' => 'Campanha não foi localizada'], 400);
        }
    }
    
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
