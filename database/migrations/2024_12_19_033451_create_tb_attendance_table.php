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
        Schema::create('tb_attendance', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('time');
            $table->enum('status', ['present', 'absent', 'late', 'out of range'])->default('absent');
            $table->foreignId('courses_id')->constrained('tb_courses');
            $table->foreignId('students_id')->constrained('tb_students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_attendance');
    }
};
