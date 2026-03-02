@extends('layouts.app')

@section('title', 'عرض عقد')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">عقد رقم {{ $contract->contract_number }}</h1>
        <div class="space-x-2 space-x-reverse">
            <a href="{{ route('contracts.edit', $contract) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                تعديل
            </a>
            <a href="{{ route('contracts.index') }}"
               class="px-4 py-2 border rounded">
                رجوع إلى القائمة
            </a>
        </div>
    </div>

    <div class="bg-white rounded shadow p-4 space-y-2">
        <p><span class="font-semibold">اسم الجهة:</span> {{ $contract->entity_name }}</p>
        <p><span class="font-semibold">نوع العقد:</span> {{ $contract->contract_type }}</p>
        <p><span class="font-semibold">تاريخ التوقيع:</span> {{ $contract->signed_at }}</p>
        <p><span class="font-semibold">مدة العقد:</span> {{ $contract->duration }}</p>
        <p><span class="font-semibold">تاريخ الانتهاء:</span> {{ $contract->end_date }}</p>
        <p><span class="font-semibold">قيمة العقد:</span> {{ number_format((float) $contract->amount, 2) }}</p>
        <p><span class="font-semibold">حالة العقد:</span> {{ $contract->status }}</p>
        <p><span class="font-semibold">تنبيه قبل الانتهاء (أيام):</span> {{ $contract->notify_before_days }}</p>
        @if ($contract->signed_pdf_path)
            <p>
                <span class="font-semibold">نسخة PDF موقعة:</span>
                <a href="{{ route('contracts.file', $contract) }}"
                   class="text-blue-600 hover:underline" target="_blank">
                    عرض الملف
                </a>
            </p>
        @endif
    </div>
@endsection

