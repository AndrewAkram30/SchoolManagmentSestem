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
        Schema::create('student_promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('From_Grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('From_Class_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('From_Section_id')->constrained('sections')->cascadeOnDelete();

            $table->foreignId('To_Grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('To_Class_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('To_Section_id')->constrained('sections')->cascadeOnDelete();
            $table->string('academic_year');
            $table->string('academic_year_new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_promotions');
    }
};
