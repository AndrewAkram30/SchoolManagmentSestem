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
    // سندات القبض
    {
        Schema::create('reciptstudents', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('Student_id')->constrained('students')->cascadeOnDelete();
            $table->decimal('debit', 8, 2)->nullable();
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reciptstudents');
    }
};
