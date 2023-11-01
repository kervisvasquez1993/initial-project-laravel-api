<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationOfThePatient extends Model
{
    use HasFactory;
    protected $table = 'location_of_the_patients';
    protected $fillable = [
        'patient_id',
        'city',
        'state',
        'address',
        'latitude',
        'longitude',
        'LandmarkOfALocation',
        'priority',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicalAppointments()
    {
        return $this->hasMany(MedicalAppointment::class, 'id', 'location_id');
    }
}
