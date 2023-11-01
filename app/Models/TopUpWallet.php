<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUpWallet extends Model
{
    use HasFactory;
    protected $table = "top_up_wallets";
    protected $fillable = [
        'wallet_id',
        'amount-to-recharge',
        'referencia',
        'status',
        'payment_method',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
