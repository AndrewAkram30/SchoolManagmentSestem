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
        Schema::create('fees_invoices', function (Blueprint $table) {
            $table->id();
               $table->date('invoice_date');
            $table->foreignId('Student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('Grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('Class_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('Free_id')->constrained('fees')->cascadeOnDelete();
            $table->decimal('amount', 8, 2);
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_invoices');
    }
};
