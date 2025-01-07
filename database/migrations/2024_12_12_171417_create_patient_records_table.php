<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_records', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->enum('status', ['healed', 'ongoing', 'critical']); // Adjust based on your data
            $table->string('identity'); // Corrected case for consistency
            $table->date('start_date'); // Changed to DATE
            $table->date('discharge_date'); // Changed to DATE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_records');
    }
}
