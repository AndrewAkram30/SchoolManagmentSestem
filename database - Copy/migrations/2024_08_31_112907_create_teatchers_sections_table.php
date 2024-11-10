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
        Schema::create('teatchers_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('Teatcher_id')->constrained('teatchers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teatchers_sections');
    }
};
