@extends('layouts.app')

@section('title', 'الإنذارات والإشعارات القانونية')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">الإنذارات والإشعارات القانونية</h1>
        <a href="{{ route('legal-notices.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            إشعار جديد
        </a>
    </div>

    <div class="bg-white rounded shadow p-4">
        <table class="w-full text-right">
            <thead>
                <tr class="border-b">
                    <th class="py-2">نوع الإشعار</th>
                    <th class="py-2">العنوان</th>
                    <th class="py-2">الجهة / المستلم</th>
                    <th class="py-2">مرتبط بعقد</th>
                    <th class="py-2">مرتبطة بقضية</th>
                    <th class="py-2">تاريخ الإرسال</th>
                    <th class="py-2">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notices as $notice)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $notice->type }}</td>
                        <td class="py-2">{{ $notice->subject }}</td>
                        <td class="py-2">{{ $notice->recipient }}</td>
                        <td class="py-2">{{ $notice->contract_id }}</td>
                        <td class="py-2">{{ $notice->legal_case_id }}</td>
                        <td class="py-2">{{ $notice->sent_at }}</td>
                        <td class="py-2 space-x-2 space-x-reverse">
                            <a href="{{ route('legal-notices.show', $notice) }}" class="text-blue-600 hover:underline">عرض</a>
                            <a href="{{ route('legal-notices.edit', $notice) }}" class="text-yellow-600 hover:underline">تعديل</a>
                            <form action="{{ route('legal-notices.destroy', $notice) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('هل أنت متأكد من حذف هذا الإشعار؟');"
                                        class="text-red-600 hover:underline">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">
                            لا توجد إشعارات مسجلة حتى الآن.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $notices->links() }}
        </div>
    </div>
@endsection

