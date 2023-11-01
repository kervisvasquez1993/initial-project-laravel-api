<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationOfTheDoctor extends Model
{
    use HasFactory;
    protected $table = "location_of_the_doctors";
    protected $fillable = [
        'doctor_id',
        'city',
        'state',
        'address',
        'latitude',
        'longitude',
        'LandmarkOfALocation',
        'priority',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function extraServiceProviderByTheDoctor()
    {
        return $this->belongsTo(ExtraServiceProviderByTheDoctor::class, 'doctor_id');
    }

    public function medicalAppointments()
    {
        return $this->hasMany(MedicalAppointment::class, 'id', 'location_id');
    }
}
