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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('supply_name', 100);
            $table->string('unit', 100);
            $table->double('initial_quantity');
            $table->double('consumed_quantity')->default(0);
            $table->double('remaining_quantity');
            $table->dateTime('expiration_date');
            $table->foreignId('box_id')->constrained()->onDelete('cascade');
            $table->string('status', 50);
            $table->softDeletes();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};