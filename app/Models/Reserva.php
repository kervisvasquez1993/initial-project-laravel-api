<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'id_horario',
        'porcentaje_lluvia',
        'id_user',
    ];

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
