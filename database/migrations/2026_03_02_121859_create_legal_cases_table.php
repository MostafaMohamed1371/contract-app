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
        Schema::create('legal_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique(); // رقم الدعوى (رقم المحكمة)
            $table->string('file_number')->nullable(); // رقم القضية الداخلي إن لزم
            $table->string('court'); // المحكمة
            $table->string('case_type'); // نوع الدعوى
            $table->string('parties'); // المدعي / المدعى عليه
            $table->string('responsible_lawyer')->nullable(); // المحامي المسؤول
            $table->dateTime('next_hearing_at')->nullable(); // تاريخ الجلسة القادمة
            $table->string('status')->default('مستمرة'); // حالة القضية (مستمرة – مؤجلة – مكتسبة الدرجة القطعية)
            $table->json('attachments')->nullable(); // مرفقات (مسارات ملفات في شكل JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_cases');
    }
};
