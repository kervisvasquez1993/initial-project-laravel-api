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
        Schema::create('extra_service_medical_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_appointment')->references('id')->on('medical_appointments')->onDelete('cascade');
            $table->foreignId('extra_service')->references('id')->on('extra_service_provider_by_the_doctors')->onDelete('cascade');
            $table->string("descripcion");
            $table->boolean('validate_patient')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_service_medical_appointments');
    }
};
