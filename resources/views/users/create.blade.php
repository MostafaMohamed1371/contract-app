@extends('layouts.app')

@section('title', 'مستخدم جديد')

@section('content')
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h1 class="text-xl font-bold text-gray-800 mb-4 text-right">إضافة مستخدم جديد</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 border border-red-100 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">الاسم الكامل</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">كلمة المرور</label>
                    <input type="password" name="password" required
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">الدور</label>
                <select name="role" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="user" {{ old('role', 'user') === 'user' ? 'selected' : '' }}>مستخدم</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>مدير</option>
                </select>
            </div>

            <div class="flex justify-end space-x-2 space-x-reverse">
                <a href="{{ route('users.index') }}" class="px-4 py-2 border rounded-lg text-sm">إلغاء</a>
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">
                    حفظ المستخدم
                </button>
            </div>
        </form>
    </div>
@endsection

