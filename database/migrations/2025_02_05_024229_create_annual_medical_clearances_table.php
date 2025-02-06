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
        Schema::create('annual_medical_clearances', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('document_id'); // Foreign key to the documents table
            $table->date('date'); // Date of the medical clearance
            $table->string('patient_name'); // Name of the patient
            $table->date('startDate'); // Start date of the clearance
            $table->date('endDate'); // End date of the clearance
            $table->string('doctorName'); // Name of the doctor
            $table->string('license_number'); // Doctor's license number
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_medical_clearances');
    }
};