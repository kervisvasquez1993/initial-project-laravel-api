<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAppointmentsTreatment extends Model
{
    use HasFactory;
    protected $table = 'medical_appointments_treatments';
    protected $fillable = [
        'medical_appointment_id',
        'description',
    ];
    public function medicalAppointment()
    {
        return $this->belongsTo(MedicalAppointment::class);
    }
}
