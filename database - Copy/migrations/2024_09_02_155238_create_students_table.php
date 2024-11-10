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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->rememberToken();
            $table->foreignId('Gender_id')->constrained('genders')->cascadeOnDelete();
            $table->foreignId('Reliagion_id')->constrained('reliagions')->cascadeOnDelete();
            $table->foreignId('Nationalite_id')->constrained('nationalites')->cascadeOnDelete();
            $table->foreignId('Type_Blood')->constrained('type__bloods')->cascadeOnDelete();
            $table->foreignId('Parent_id')->constrained('my_parents')->cascadeOnDelete();
            $table->foreignId('Grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('Classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->date('Date_Birth');
            $table->string('Acadmic_Year');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
