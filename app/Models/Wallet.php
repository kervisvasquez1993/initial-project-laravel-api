<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = "wallets";
    protected $fillable = [
        'user_id',
        'balance',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function topUpWallets() {
        return $this->hasMany(TopUpWallet::class);
    }

    public function medicalServiceCosts() {
        return $this->belongsToMany(MedicalServiceCost::class);
    }
}
