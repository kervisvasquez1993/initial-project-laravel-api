<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('top_up_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->integer('amount-to-recharge')->default(0);
            $table->string("referencia");
            $table->enum("status", ["pending", "approved", "rejected"])->default("pending");
            $table->enum("payment_method", ["pago_movil", "efectivo", "transfer"])->default("pago_movil");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_up_wallets');
    }
};
