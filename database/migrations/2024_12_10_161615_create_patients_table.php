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
            $table->string("firstName");
            $table->string("lastName");
            $table->string("middleName")->nullable();
            $table->string("patientType");
            $table->date("dateOfBirth");
            $table->string("diseaseSeverity");
            $table->string("patientStatus");
            $table->string("contactDetails");
            $table->string("address");
            $table->string("registrationDate");
            $table->boolean("isFullyHealed")->default(false);
            $table->string("assignedDoctorPhysician");
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
