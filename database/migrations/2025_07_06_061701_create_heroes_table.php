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
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('hero_title')->default('Find Your Dream Home');
            $table->text('hero_description')->default('Discover the finest properties in Cavite. Your next chapter begins here. We are committed to helping you find your dream home with personalized service and expert guidance.');
            $table->string('hero_image')->default('images/hero.jpg');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
