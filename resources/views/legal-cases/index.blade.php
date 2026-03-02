@extends('layouts.app')

@section('title', 'إدارة القضايا')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">القضايا</h1>
        <a href="{{ route('legal-cases.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            قضية جديدة
        </a>
    </div>

    <div class="bg-white rounded shadow p-4">
        <table class="w-full text-right">
            <thead>
                <tr class="border-b">
                    <th class="py-2">رقم الدعوى</th>
                    <th class="py-2">رقم القضية</th>
                    <th class="py-2">المحكمة</th>
                    <th class="py-2">نوع الدعوى</th>
                    <th class="py-2">المدعي / المدعى عليه</th>
                    <th class="py-2">تاريخ الجلسة القادمة</th>
                    <th class="py-2">حالة القضية</th>
                    <th class="py-2">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cases as $case)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $case->case_number }}</td>
                        <td class="py-2">{{ $case->file_number }}</td>
                        <td class="py-2">{{ $case->court }}</td>
                        <td class="py-2">{{ $case->case_type }}</td>
                        <td class="py-2">{{ $case->parties }}</td>
                        <td class="py-2">{{ $case->next_hearing_at }}</td>
                        <td class="py-2">{{ $case->status }}</td>
                        <td class="py-2 space-x-2 space-x-reverse">
                            <a href="{{ route('legal-cases.show', $case) }}" class="text-blue-600 hover:underline">عرض</a>
                            <a href="{{ route('legal-cases.edit', $case) }}" class="text-yellow-600 hover:underline">تعديل</a>
                            <form action="{{ route('legal-cases.destroy', $case) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('هل أنت متأكد من حذف هذه القضية؟');"
                                        class="text-red-600 hover:underline">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-4 text-center text-gray-500">
                            لا توجد قضايا مسجلة حتى الآن.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $cases->links() }}
        </div>
    </div>
@endsection

