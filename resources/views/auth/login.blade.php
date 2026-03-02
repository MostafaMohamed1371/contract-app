@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h1 class="text-xl font-bold text-gray-800 mb-4 text-center">تسجيل الدخول</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 border border-red-100 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">كلمة المرور</label>
                <input type="password" name="password" required
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center space-x-2 space-x-reverse">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span>تذكرني</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">
                دخول
            </button>

            <p class="mt-3 text-xs text-gray-500 text-center">
                لا تملك حساباً؟ <a href="{{ route('register') }}" class="text-blue-600 hover:underline">إنشاء حساب جديد</a>
            </p>
        </form>
    </div>
@endsection

