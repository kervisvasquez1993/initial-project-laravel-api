<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = "doctors";
    protected $fillable = [
        'user_id',
        'disponible',
        'verificado_certificados',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function extraServiceProviders() {
        return $this->hasMany(ExtraServiceProviderByTheDoctor::class);
    }

    public function medicalAppointments() {
        return $this->hasMany(MedicalAppointment::class);
    }

    public function extraServiceMedicalAppointments() {
        return $this->hasMany(ExtraServiceMedicalAppointment::class);
    }

    public function medicalAppointmentsQualifications() {
        return $this->hasManyThrough(MedicalAppointmentsQualification::class, MedicalAppointment::class);
    }

    public function medicalAppointmentsReports() {
        return $this->hasManyThrough(MedicalAppointmentsReport::class, MedicalAppointment::class);
    }

    public function medicalAppointmentsTreatments() {
        return $this->hasManyThrough(MedicalAppointmentsTreatment::class, MedicalAppointment::class);
    }

    public function medicalServiceCosts() {
        return $this->belongsToMany(MedicalServiceCost::class);
    }

    public function specialties() {
        return $this->belongsToMany(Specialty::class);
    }

    public function locations() {
        return $this->hasMany(LocationOfTheDoctor::class);
    }

}
