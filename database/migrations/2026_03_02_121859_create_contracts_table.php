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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->unique(); // رقم العقد
            $table->string('entity_name'); // اسم الجهة
            $table->string('contract_type'); // نوع العقد (صيانة – تقنية – توريد – استشارة…)
            $table->date('signed_at')->nullable(); // تاريخ التوقيع
            $table->string('duration')->nullable(); // مدة العقد (نص حر مثل "12 شهر")
            $table->date('end_date')->nullable(); // تاريخ الانتهاء
            $table->decimal('amount', 15, 2)->nullable(); // قيمة العقد
            $table->string('status')->default('فعال'); // حالة العقد (فعال – منتهي – ملغى)
            $table->string('signed_pdf_path')->nullable(); // مسار نسخة PDF موقعة
            $table->unsignedInteger('notify_before_days')->default(30); // تنبيه قبل الانتهاء بـ 30 يوم
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
