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
        Schema::create('teatchers', function (Blueprint $table) {
            $table->id();
            $table->string('Email')->unique();
            // $table->timestamp('Email_Verfied_at')->nullable();
            // يُنشئ عمودًا من نوع Timestamp يسمى email_verified_at.  هذا العمود يُستخدم لتخزين الوقت الذي تم فيه التحقق من صحة البريد الإلكتروني للمستخد
            $table->string('Password');
            $table->rememberToken();
            $table->string('Name');
            $table->foreignId('Gender_id')->constrained('genders')->cascadeOnDelete();
            $table->foreignId('Specialization_id')->constrained('specializations')->cascadeOnDelete();
            $table->string('Address');
            $table->string('Phone_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teatchers');
    }
};
