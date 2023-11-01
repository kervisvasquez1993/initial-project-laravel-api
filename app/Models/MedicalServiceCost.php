<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalServiceCost extends Model
{
    use HasFactory;
    protected $table = "medical_service_costs";
    protected $fillable = [
        'type_of_medical_appointment_id',
        'doctor_id',
        'specialty_id',
        'cost',
    ];
    public function typeOfMedicalAppointment() {
        return $this->belongsTo(TypeOfMedicalAppointment::class);
    }

    public function medicalService() {
        return $this->belongsTo(MedicalService::class);
    }

    public function specialty() {
        return $this->belongsTo(Specialty::class);
    }

    public function medicalAppointments() {
        return $this->hasMany(MedicalAppointment::class);
    }
}
