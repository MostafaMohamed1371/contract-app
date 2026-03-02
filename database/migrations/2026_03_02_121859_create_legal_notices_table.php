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
        Schema::create('legal_notices', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // نوع الإشعار: إنذار تسديد، إنذار فسخ عقد، إنذار تقصير، مطالبة مالية
            $table->string('subject')->nullable(); // عنوان مختصر
            $table->text('content')->nullable(); // نص الإشعار
            $table->foreignId('contract_id')->nullable()->constrained('contracts')->nullOnDelete(); // ربط اختياري بعقد
            $table->foreignId('legal_case_id')->nullable()->constrained('legal_cases')->nullOnDelete(); // ربط اختياري بقضية
            $table->dateTime('sent_at')->nullable(); // تاريخ الإرسال
            $table->string('recipient')->nullable(); // اسم المستلم أو الجهة
            $table->string('attachment_path')->nullable(); // مرفق واحد (مثل PDF)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_notices');
    }
};
