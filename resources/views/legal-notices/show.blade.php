@extends('layouts.app')

@section('title', 'عرض إشعار')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">إشعار: {{ $notice->subject ?? $notice->type }}</h1>
        <div class="space-x-2 space-x-reverse">
            <a href="{{ route('legal-notices.edit', $notice) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                تعديل
            </a>
            <a href="{{ route('legal-notices.index') }}"
               class="px-4 py-2 border rounded">
                رجوع إلى القائمة
            </a>
        </div>
    </div>

    <div class="bg-white rounded shadow p-4 space-y-2">
        <p><span class="font-semibold">نوع الإشعار:</span> {{ $notice->type }}</p>
        <p><span class="font-semibold">العنوان:</span> {{ $notice->subject }}</p>
        <p><span class="font-semibold">نص الإشعار:</span></p>
        <p class="whitespace-pre-line">{{ $notice->content }}</p>
        <p><span class="font-semibold">المستلم / الجهة:</span> {{ $notice->recipient }}</p>
        <p><span class="font-semibold">مرتبط بعقد (ID):</span> {{ $notice->contract_id }}</p>
        <p><span class="font-semibold">مرتبطة بقضية (ID):</span> {{ $notice->legal_case_id }}</p>
        <p><span class="font-semibold">تاريخ الإرسال:</span> {{ $notice->sent_at }}</p>
        @if ($notice->attachment_path)
            <p>
                <span class="font-semibold">المرفق:</span>
                <a href="{{ route('legal-notices.attachment', $notice) }}"
                   class="text-blue-600 hover:underline" target="_blank">
                    عرض الملف
                </a>
            </p>
        @endif
    </div>
@endsection

