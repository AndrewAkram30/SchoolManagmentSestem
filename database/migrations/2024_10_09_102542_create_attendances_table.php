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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Teatcher_id')->constrained('teatchers')->cascadeOnDelete();
            $table->foreignId('Student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('Grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('Section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('Class_id')->constrained('classrooms')->cascadeOnDelete();
            $table->date('attendance_date');
            $table->boolean('attendance_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
