<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfMedicalAppointment extends Model
{
    use HasFactory;
    protected $table = "type_of_medical_appointments";
    protected $fillable = [
        "name"];

    public function medicalServiceCosts()
    {
        return $this->hasMany(MedicalServiceCost::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function medicalAppointments()
    {
        return $this->hasManyThrough(MedicalAppointment::class, MedicalServiceCost::class);
    }

    public function extraServiceMedicalAppointments()
    {
        return $this->hasMany(ExtraServiceMedicalAppointment::class);
    }
    // 5. Relación de uno a muchos con `MedicalAppointment` a través de `MedicalServiceCost` y `Patient`
    public function patientMedicalAppointments(Patient $patient)
    {
        return $this->hasManyThrough(MedicalAppointment::class, MedicalServiceCost::class, 'type_of_medical_appointment_id', 'medical_service_cost_id')
            ->where('patient_id', $patient->id);
    }
    // Relación de uno a muchos con `Doctor` a través de `MedicalServiceCost` y `ExtraServiceProviderByTheDoctor`:
    public function doctors()
    {
        return $this->hasManyThrough(Doctor::class, MedicalServiceCost::class, 'type_of_medical_appointment_id', 'id', 'id', 'doctor_id')
            ->join('extra_service_provider_by_the_doctors', 'extra_service_provider_by_the_doctors.doctor_id', '=', 'doctors.id');
    }
}
