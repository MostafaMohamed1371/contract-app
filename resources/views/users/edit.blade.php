@extends('layouts.app')

@section('title', 'تعديل مستخدم')

@section('content')
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h1 class="text-xl font-bold text-gray-800 mb-4 text-right">تعديل مستخدم: {{ $user->name }}</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 border border-red-100 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">الاسم الكامل</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">الدور</label>
                <select name="role" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>مستخدم</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>مدير</option>
                </select>
                @if (auth()->id() === $user->id)
                    <p class="mt-1 text-xs text-gray-400">لا يمكنك إزالة صلاحيات المدير عن نفسك.</p>
                @endif
            </div>

            <hr class="my-3">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">كلمة مرور جديدة (اختياري)</label>
                <input type="password" name="password"
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="اتركه فارغاً إذا لا تريد تغيير كلمة المرور">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">تأكيد كلمة المرور الجديدة</label>
                <input type="password" name="password_confirmation"
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-end space-x-2 space-x-reverse">
                <a href="{{ route('users.index') }}" class="px-4 py-2 border rounded-lg text-sm">إلغاء</a>
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
@endsection

