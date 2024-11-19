<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('welcome_text');
            $table->string('slogan');
            $table->longText('description');
            $table->string('email');
            $table->string('contact');
            $table->string('address');
            $table->string('fbLink')->nullable();
            $table->string('instaLink')->nullable();
            $table->string('linkedInLink')->nullable();
            $table->timestamps();
        }); 
        // Trigger seeder after table creation
        Artisan::call('db:seed', [
            '--class' => 'CompanySeeder'
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
