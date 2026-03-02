@extends('layouts.app')

@section('title', 'إدارة العقود')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">العقود</h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('contracts.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                عقد جديد
            </a>
        @endif
    </div>

    <div class="bg-white rounded shadow p-4">
        <table class="w-full text-right">
            <thead>
                <tr class="border-b">
                    <th class="py-2">رقم العقد</th>
                    <th class="py-2">اسم الجهة</th>
                    <th class="py-2">نوع العقد</th>
                    <th class="py-2">تاريخ الانتهاء</th>
                    <th class="py-2">قيمة العقد</th>
                    <th class="py-2">الحالة</th>
                    <th class="py-2">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contracts as $contract)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $contract->contract_number }}</td>
                        <td class="py-2">{{ $contract->entity_name }}</td>
                        <td class="py-2">{{ $contract->contract_type }}</td>
                        <td class="py-2">{{ $contract->end_date }}</td>
                        <td class="py-2">{{ number_format((float) $contract->amount, 2) }}</td>
                        <td class="py-2">{{ $contract->status }}</td>
                        <td class="py-2 space-x-2 space-x-reverse">
                            <a href="{{ route('contracts.show', $contract) }}" class="text-blue-600 hover:underline">عرض</a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('contracts.edit', $contract) }}" class="text-yellow-600 hover:underline">تعديل</a>
                                <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا العقد؟');"
                                            class="text-red-600 hover:underline">
                                        حذف
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">
                            لا توجد عقود مسجلة حتى الآن.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $contracts->links() }}
        </div>
    </div>
@endsection

