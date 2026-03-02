@extends('layouts.app')

@section('title', 'إشعار جديد')

@section('content')
    <h1 class="text-2xl font-bold mb-4">إضافة إشعار / إنذار جديد</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('legal-notices.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded shadow p-4 space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">نوع الإشعار</label>
                <select name="type" class="w-full border rounded px-3 py-2" required>
                    @php $type = old('type'); @endphp
                    <option value="">اختر النوع</option>
                    <option value="إنذار تسديد" {{ $type === 'إنذار تسديد' ? 'selected' : '' }}>إنذار تسديد</option>
                    <option value="إنذار فسخ عقد" {{ $type === 'إنذار فسخ عقد' ? 'selected' : '' }}>إنذار فسخ عقد</option>
                    <option value="إنذار تقصير" {{ $type === 'إنذار تقصير' ? 'selected' : '' }}>إنذار تقصير</option>
                    <option value="مطالبة مالية" {{ $type === 'مطالبة مالية' ? 'selected' : '' }}>مطالبة مالية</option>
                    <option value="أخرى" {{ $type === 'أخرى' ? 'selected' : '' }}>أخرى</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">العنوان</label>
                <input type="text" name="subject" value="{{ old('subject') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">نص الإشعار</label>
            <textarea name="content" rows="4"
                      class="w-full border rounded px-3 py-2">{{ old('content') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-1 font-semibold">مرتبط بعقد (اختياري)</label>
                <select name="contract_id" class="w-full border rounded px-3 py-2">
                    <option value="">بدون</option>
                    @foreach ($contracts as $contract)
                        <option value="{{ $contract->id }}" {{ old('contract_id') == $contract->id ? 'selected' : '' }}>
                            {{ $contract->contract_number }} - {{ $contract->entity_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">مرتبطة بقضية (اختياري)</label>
                <select name="legal_case_id" class="w-full border rounded px-3 py-2">
                    <option value="">بدون</option>
                    @foreach ($cases as $case)
                        <option value="{{ $case->id }}" {{ old('legal_case_id') == $case->id ? 'selected' : '' }}>
                            {{ $case->case_number }} - {{ $case->court }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">تاريخ الإرسال</label>
                <input type="datetime-local" name="sent_at" value="{{ old('sent_at') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">المستلم / الجهة</label>
                <input type="text" name="recipient" value="{{ old('recipient') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-semibold">مرفق (مثال: PDF)</label>
                <input type="file" name="attachment"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex justify-end space-x-2 space-x-reverse">
            <a href="{{ route('legal-notices.index') }}" class="px-4 py-2 border rounded">إلغاء</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                حفظ
            </button>
        </div>
    </form>
@endsection

