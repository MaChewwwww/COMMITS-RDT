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
        Schema::create('excuseletter', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('phone_number', 15); // Patient's phone number
            $table->date('date'); // The date for the excuse letter
            $table->string('patient_name'); // Name of the patient
            $table->date('excuse_for'); // Date the excuse applies to
            $table->string('cause'); // Reason for the excuse
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade'); // Foreign key for the document
            $table->timestamps(); // created_at and updated_at columns
            $table->string('doctorName');
            $table->string('address');
            $table->date('date_today');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excuseletter');
    }
};
