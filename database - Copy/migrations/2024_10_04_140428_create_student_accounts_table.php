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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('fee_invoices_id')->constrained('fees_invoices')->cascadeOnDelete();
            $table->foreignId('recipt_id')->constrained('reciptstudents')->cascadeOnDelete();
            $table->foreignId('Student_id')->constrained('students')->cascadeOnDelete();
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('Credit',8,2)->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
};
