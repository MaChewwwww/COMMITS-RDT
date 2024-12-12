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
            $table->string('stock_number', 100); // Corrected `Box Name`
            $table->string('supplier_name', 150); // Corrected `Supplier Name`
            $table->boolean('isReturned')->default(false);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Reference the box to user
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
