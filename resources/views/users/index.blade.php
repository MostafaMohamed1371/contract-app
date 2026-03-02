@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">إدارة المستخدمين</h1>
        <a href="{{ route('users.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
            مستخدم جديد
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 border border-red-100 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded shadow p-4">
        <table class="w-full text-right text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 px-2">#</th>
                    <th class="py-2 px-2">الاسم</th>
                    <th class="py-2 px-2">البريد الإلكتروني</th>
                    <th class="py-2 px-2">الدور</th>
                    <th class="py-2 px-2">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-2">{{ $user->id }}</td>
                        <td class="py-2 px-2">{{ $user->name }}</td>
                        <td class="py-2 px-2">{{ $user->email }}</td>
                        <td class="py-2 px-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs
                                         {{ $user->isAdmin() ? 'bg-purple-50 text-purple-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $user->isAdmin() ? 'مدير' : 'مستخدم' }}
                            </span>
                        </td>
                        <td class="py-2 px-2 space-x-2 space-x-reverse">
                            <a href="{{ route('users.edit', $user) }}"
                               class="text-xs text-yellow-600 hover:underline">
                                تعديل
                            </a>
                            @if (auth()->id() !== $user->id)
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟');"
                                            class="text-xs text-red-600 hover:underline">
                                        حذف
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400">لا يمكن حذف حسابك</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">
                            لا يوجد مستخدمون.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection

