<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = [
        'hora_inicio',
        'hora_cierre',
        'dia_semana',
        'id_cancha',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_horario');
    }

    public function cancha()
    {
        return $this->belongsTo(Cancha::class, 'id_cancha');
    }

}
