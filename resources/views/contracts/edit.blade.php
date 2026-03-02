@extends('layouts.app')

@section('title', 'تعديل عقد')

@section('content')
    <h1 class="text-2xl font-bold mb-4">تعديل عقد: {{ $contract->contract_number }}</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contracts.update', $contract) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded shadow p-4 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">رقم العقد</label>
            <input type="text" name="contract_number" value="{{ old('contract_number', $contract->contract_number) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">اسم الجهة</label>
            <input type="text" name="entity_name" value="{{ old('entity_name', $contract->entity_name) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">نوع العقد</label>
            <input type="text" name="contract_type" value="{{ old('contract_type', $contract->contract_type) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-1 font-semibold">تاريخ التوقيع</label>
                <input type="date" name="signed_at" value="{{ old('signed_at', optional($contract->signed_at)->format('Y-m-d')) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-semibold">مدة العقد</label>
                <input type="text" name="duration" value="{{ old('duration', $contract->duration) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-semibold">تاريخ الانتهاء</label>
                <input type="date" name="end_date" value="{{ old('end_date', optional($contract->end_date)->format('Y-m-d')) }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">قيمة العقد</label>
                <input type="number" step="0.01" name="amount" value="{{ old('amount', $contract->amount) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-semibold">حالة العقد</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    @php $status = old('status', $contract->status); @endphp
                    <option value="فعال" {{ $status === 'فعال' ? 'selected' : '' }}>فعال</option>
                    <option value="منتهي" {{ $status === 'منتهي' ? 'selected' : '' }}>منتهي</option>
                    <option value="ملغى" {{ $status === 'ملغى' ? 'selected' : '' }}>ملغى</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">تنبيه قبل الانتهاء (بالأيام)</label>
                <input type="number" name="notify_before_days" value="{{ old('notify_before_days', $contract->notify_before_days ?? 30) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-semibold">نسخة PDF موقعة (اختياري لتحديث الملف)</label>
                <input type="file" name="signed_pdf" accept="application/pdf"
                       class="w-full border rounded px-3 py-2">
                @if ($contract->signed_pdf_path)
                    <p class="mt-1 text-sm text-gray-600">
                        ملف حالي: {{ $contract->signed_pdf_path }}
                    </p>
                @endif
            </div>
        </div>

        <div class="flex justify-end space-x-2 space-x-reverse">
            <a href="{{ route('contracts.index') }}" class="px-4 py-2 border rounded">إلغاء</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                حفظ التعديلات
            </button>
        </div>
    </form>
@endsection

