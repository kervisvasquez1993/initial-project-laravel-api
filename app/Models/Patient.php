<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = "patients";
    protected $fillable = [
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function medicalAppointments() {
        return $this->hasMany(MedicalAppointment::class);
    }

    public function wallets() {
        return $this->hasMany(Wallet::class);
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

    public function extraServiceMedicalAppointments() {
        return $this->hasMany(ExtraServiceMedicalAppointment::class, 'validate_patient');
    }

    public function locationsOfThePatient() {
        return $this->hasMany(LocationOfThePatient::class);
    }

    public function topUpWallets() {
        return $this->hasManyThrough(TopUpWallet::class, Wallet::class);
    }
}
