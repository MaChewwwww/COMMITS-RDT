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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('year_course_dept')->nullable();
            $table->string('contactDetails');
            $table->string('patient_status');
            $table->enum('patientType', ['Student', 'Faculty', 'Admin', 'Visitor', 'Dependent']);
            $table->string('student_number')->nullable();
            $table->foreignId('physician_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
