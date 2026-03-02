@extends('layouts.app')

@section('title', 'عرض قضية')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">قضية رقم {{ $case->case_number }}</h1>
        <div class="space-x-2 space-x-reverse">
            <a href="{{ route('legal-cases.edit', $case) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                تعديل
            </a>
            <a href="{{ route('legal-cases.index') }}"
               class="px-4 py-2 border rounded">
                رجوع إلى القائمة
            </a>
        </div>
    </div>

    <div class="bg-white rounded shadow p-4 space-y-2">
        <p><span class="font-semibold">رقم القضية:</span> {{ $case->file_number }}</p>
        <p><span class="font-semibold">المحكمة:</span> {{ $case->court }}</p>
        <p><span class="font-semibold">نوع الدعوى:</span> {{ $case->case_type }}</p>
        <p><span class="font-semibold">المدعي / المدعى عليه:</span> {{ $case->parties }}</p>
        <p><span class="font-semibold">المحامي المسؤول:</span> {{ $case->responsible_lawyer }}</p>
        <p><span class="font-semibold">تاريخ الجلسة القادمة:</span> {{ $case->next_hearing_at }}</p>
        <p><span class="font-semibold">حالة القضية:</span> {{ $case->status }}</p>
    </div>
@endsection

