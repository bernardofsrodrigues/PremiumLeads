<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'banco_id',
        'limite',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function banco()
    {
        return $this->belongsTo(Bancos::class);
    }
}
