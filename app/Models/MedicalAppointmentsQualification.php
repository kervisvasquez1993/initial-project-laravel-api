<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAppointmentsQualification extends Model
{
    use HasFactory;
    protected $table = 'medical_appointments_qualifications';
    protected $fillable = [
        'medical_appointment_id',
        'qualification',
    ];

    public function medicalAppointment()
    {
        return $this->belongsTo(MedicalAppointment::class);
    }
}
