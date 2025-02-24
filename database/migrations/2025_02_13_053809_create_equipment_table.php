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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('general_description');
            $table->integer('quantity');
            $table->integer('quantity_of_request');
            $table->boolean('serviceable')->default(false);
            $table->boolean('for_repair')->default(false);
            $table->boolean('for_condemn')->default(false);
            $table->boolean('need_replacement')->default(false);
            $table->boolean('additional')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Memorandum of receipt
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
