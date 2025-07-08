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
        Schema::table('contact_us', function (Blueprint $table) {
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('facebook')->nullable()->change();
            $table->string('twitter')->nullable()->change();
            $table->string('instagram')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn('youtube');
            $table->dropColumn('tiktok');
            $table->string('facebook')->nullable(false)->change();
            $table->string('twitter')->nullable(false)->change();
            $table->string('instagram')->nullable(false)->change();
        });
    }
};
