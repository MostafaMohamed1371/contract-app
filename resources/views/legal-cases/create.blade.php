@extends('layouts.app')

@section('title', 'قضية جديدة')

@section('content')
    <h1 class="text-2xl font-bold mb-4">إضافة قضية جديدة</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('legal-cases.store') }}" method="POST" class="bg-white rounded shadow p-4 space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">رقم الدعوى</label>
                <input type="text" name="case_number" value="{{ old('case_number') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">رقم القضية</label>
                <input type="text" name="file_number" value="{{ old('file_number') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">المحكمة</label>
                <input type="text" name="court" value="{{ old('court') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">نوع الدعوى</label>
                <input type="text" name="case_type" value="{{ old('case_type') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">المدعي / المدعى عليه</label>
            <textarea name="parties" rows="2"
                      class="w-full border rounded px-3 py-2"
                      required>{{ old('parties') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">المحامي المسؤول</label>
                <input type="text" name="responsible_lawyer" value="{{ old('responsible_lawyer') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-semibold">تاريخ الجلسة القادمة</label>
                <input type="datetime-local" name="next_hearing_at" value="{{ old('next_hearing_at') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">حالة القضية</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="مستمرة" {{ old('status', 'مستمرة') === 'مستمرة' ? 'selected' : '' }}>مستمرة</option>
                <option value="مؤجلة" {{ old('status') === 'مؤجلة' ? 'selected' : '' }}>مؤجلة</option>
                <option value="مكتسبة الدرجة القطعية" {{ old('status') === 'مكتسبة الدرجة القطعية' ? 'selected' : '' }}>مكتسبة الدرجة القطعية</option>
            </select>
        </div>

        <div class="flex justify-end space-x-2 space-x-reverse">
            <a href="{{ route('legal-cases.index') }}" class="px-4 py-2 border rounded">إلغاء</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                حفظ
            </button>
        </div>
    </form>
@endsection

