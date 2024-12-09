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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name', 100);
            $table->string('description', 250)->nullable(); // Consider making nullable
            $table->string('unit_of_measurement', 100);
            $table->double('initial_quantity'); // Add precision and scale
            $table->double('consumed_quantity')->default(0); // Add default
            $table->double('remaining_quantity'); // Add precision and scale
            $table->dateTime('expiration_date');
            $table->foreignId('box_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
