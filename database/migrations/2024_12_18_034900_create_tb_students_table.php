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
        Schema::create('tb_students', function (Blueprint $table) {
            $table->id();
            $table->string('NIM')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('departement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_students');
    }
};
