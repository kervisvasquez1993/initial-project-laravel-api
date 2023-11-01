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
        Schema::create('medical_appointments_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_appointment_id')->references('id')->on('medical_appointments')->onDelete('cascade');
            $table->integer('qualification')->default(0)->max(5)->min(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_appointments_qualifications');
    }
};
