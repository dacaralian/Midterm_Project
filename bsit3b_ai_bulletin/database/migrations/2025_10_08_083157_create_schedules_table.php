<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('time');
            $table->string('course_code');
            $table->string('course_name');
            $table->string('instructor');
            $table->string('building');
            $table->string('room');
            $table->timestamps();
        });
    }
    
    
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
