<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs_atividades extends Model
{
    use HasFactory;

    /**
     * Função estática para criar o log.
     *
     * @param int $user_id
     * @param int $status
     * @param string $message
     * 
     * @return Logs_atividades|null
     */
    public static function CreatedLog($user_id,$status,$message)
    {
        $color = self::getColor($status);

        $log = new Logs_atividades;
        $log->user_id = $user_id;
        $log->status = $status;
        $log->message = $message;
        $log->color = $color;

        $log->save();

        if($log){
            return ['status'=>200,'message'=>"Log registrada com sucesso"];
        }else{
            return ['status'=>400,'message'=>"Não foi possivel registrar a log"];
        }
    }

    private static function getColor($status)
    {
        // Define as cores correspondentes aos status
        $colors = [
            '200'=>"success",
            '400'=>"warning",
            '500'=>"danger",
        ];

        // Retorna a cor correspondente ao status ou uma cor padrão
        return $colors[$status] ?? 'primary';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
