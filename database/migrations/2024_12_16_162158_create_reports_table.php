<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table): void {
            $table->id();
            $table->string('title'); // Ensure this field exists
            $table->string('name');
            $table->integer('age');
            $table->string('sex');
            $table->text('complaint');
            $table->text('diagnosis');
            $table->text('remarks')->nullable();
            $table->string('category');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('reports');
        Schema::table('reports', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}