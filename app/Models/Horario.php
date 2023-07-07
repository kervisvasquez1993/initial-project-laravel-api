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

}
