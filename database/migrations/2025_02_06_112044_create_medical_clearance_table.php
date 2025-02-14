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
        Schema::create('medical_clearances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->date('date');
            $table->string('patient_name');
            $table->enum('vaccination_status', [
                'Unvaccinated',
                'Primary series incomplete',
                'Primary dose / series completed',
                '1st Booster',
                '2nd Booster'
            ]);            
            $table->string('remarks');
            $table->string('position');
            $table->string('license_number');
            $table->timestamps();
            $table->string('document_type')->default('medical_clearance');
            $table->date('additional_date')->nullable();
            $table->string('additional_patient_name')->nullable();
            $table->enum('additional_vaccination_status', [
                'Unvaccinated',
                'Primary series incomplete',
                'Primary dose / series completed',
                '1st Booster',
                '2nd Booster'
            ])->nullable();
            $table->string('additional_remarks')->nullable();
            $table->string('additional_position')->nullable();
            $table->string('additional_license_number')->nullable();
        
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_clearance');
    }
};
