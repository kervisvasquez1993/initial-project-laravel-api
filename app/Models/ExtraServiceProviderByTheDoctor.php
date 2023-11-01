<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraServiceProviderByTheDoctor extends Model
{
    use HasFactory;
    protected $table = "extra_service_provider_by_the_doctors";
    protected $fillable = [
        'doctor_id',
        'name',
        'description',
        'cost',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function extraServiceMedicalAppointments()
    {
        return $this->hasMany(ExtraServiceMedicalAppointment::class, 'extra_service_id');
    }

    public function locations()
    {
        return $this->hasMany(LocationOfTheDoctor::class, 'doctor_id');
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'extra_service_provider_specialties', 'extra_service_provider_id', 'specialty_id');
    }
}
