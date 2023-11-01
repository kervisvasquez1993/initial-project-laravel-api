<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $table = "specialties";
    protected $fillable = [
        'name',
        'description',
    ];
    public function medicalServiceCosts() {
        return $this->hasMany(MedicalServiceCost::class);
    }

    public function doctors() {
        return $this->belongsToMany(Doctor::class);
    }
}
