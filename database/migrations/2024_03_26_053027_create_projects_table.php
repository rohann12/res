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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('short_description')->nullable();
            $table->boolean('on_carousel')->default(false);
            $table->boolean('featured')->default(false);
            // $table->string('client');
            // $table->string('architect');
            // $table->string('builder');
            // $table->string('budget');
            $table->enum('status', ['upcoming', 'running', 'completed']);
            $table->timestamps();          
        });
           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
