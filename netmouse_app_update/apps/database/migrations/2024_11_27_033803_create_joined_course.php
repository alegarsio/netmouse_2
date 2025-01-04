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
        Schema::create('joined_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // ID dari student (users)
            $table->unsignedBigInteger('course_id'); // ID dari course
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joined_course');
    }
};
