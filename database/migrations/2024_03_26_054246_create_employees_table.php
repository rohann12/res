<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('position');
            $table->string('photo_url')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->integer('order');
            $table->boolean('is_active')->default(false);
            $table->date('joined_date')->format('y-m-d');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
