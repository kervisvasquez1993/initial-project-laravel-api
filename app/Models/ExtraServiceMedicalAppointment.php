<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraServiceMedicalAppointment extends Model
{
    use HasFactory;
    protected $table = "extra_service_medical_appointments";
    protected $fillable = [
        'medical_appointment',
        'extra_service',
        'descripcion',
        'validate_patient'
    ];


    public function medicalAppointment() {
        return $this->belongsTo(MedicalAppointment::class);
    }

    public function extraServiceProvider() {
        return $this->belongsTo(ExtraServiceProviderByTheDoctor::class);
    }

    public function doctors() {
        return $this->belongsToMany(Doctor::class, 'extra_service_provider_by_the_doctors', 'extra_service_id', 'doctor_id');
    }

    public function patients() {
        return $this->belongsToMany(Patient::class, 'medical_appointments', 'id', 'patient_id');
    }

    public function medicalServiceCost() {
        return $this->hasOne(MedicalServiceCost::class, 'id', 'medical_service_cost_id');
    }
}
