<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAppointment extends Model
{
    use HasFactory;
    protected $table = "medical_appointments";
    protected $fillable = [
        'patient_id',
        'medical_service_cost_id',
        'date-of-appointment',
        'hour-of-appointment',
        'cots',
        'is_paidp',
        'attended',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicalServiceCost()
    {
        return $this->belongsTo(MedicalServiceCost::class);
    }

    public function medicalAppointmentsQualifications()
    {
        return $this->hasMany(MedicalAppointmentsQualification::class);
    }

    public function medicalAppointmentsReports()
    {
        return $this->hasMany(MedicalAppointmentsReport::class);
    }

    public function medicalAppointmentsTreatments()
    {
        return $this->hasMany(MedicalAppointmentsTreatment::class);
    }

    public function extraServiceMedicalAppointments()
    {
        return $this->hasMany(ExtraServiceMedicalAppointment::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id', 'doctor_id');
    }
}
