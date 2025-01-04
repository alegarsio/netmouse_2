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
        Schema::create('joined_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('username', 'id') // Referensi ke tabel username dan kolom id
                ->onDelete('cascade');
            $table->foreignId('course_id')
                ->constrained('courses', 'id') // Referensi ke tabel courses dan kolom id
                ->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joined_courses');
    }
};
