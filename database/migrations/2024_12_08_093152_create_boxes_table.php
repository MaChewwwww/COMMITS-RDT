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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // Includes `created_at` and `updated_at`
            $table->timestamp('date_received')->nullable(); // Corrected `Date Received`
            $table->string('box_name', 100); // Corrected `Box Name`
            $table->string('description', 250); // Corrected `Description`
            $table->string('status', 50); // Corrected `Status`
            $table->string('supplier_name', 150); // Corrected `Supplier Name`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
