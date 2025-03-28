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
        Schema::create('fees', function (Blueprint $table) {

            $table->id();
            $table->string('title', 100);
            $table->decimal('amount',8,2);
            $table->foreignId('Grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('Class_id')->constrained('classrooms')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->string('year');
            $table->integer('free_type');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
