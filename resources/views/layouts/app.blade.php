<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') | نظام إدارة العقود والقضايا</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <style>
        body { font-family: 'Tajawal', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    @php
        $isAuthPage = request()->routeIs('login') || request()->routeIs('register');
    @endphp

    @if ($isAuthPage)
        <div class="min-h-screen flex items-center justify-center px-4">
            <div class="w-full max-w-md">
                @yield('content')
            </div>
        </div>
    @else
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg hidden md:flex md:flex-col">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center space-x-3 space-x-reverse">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white">
                        <!-- simple icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 4h7v7H4zM13 4h7v4h-7zM13 11h7v9h-7zM4 13h7v7H4z" stroke-width="1.6"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-400">لوحة التحكم</div>
                        <div class="text-lg font-semibold text-gray-800">نظام العقود والقضايا</div>
                    </div>
                </div>
                <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-3 py-2 rounded-lg transition
                              {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="ml-3">
                            <!-- home icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 11.5L12 4l8 7.5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 10.5V20h12v-9.5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span>الرئيسية</span>
                    </a>
                    <a href="{{ route('contracts.index') }}"
                       class="flex items-center px-3 py-2 rounded-lg transition
                              {{ request()->routeIs('contracts.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="ml-3">
                            <!-- document icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M7 3h7l5 5v13H7z" stroke-width="1.6" stroke-linejoin="round"/>
                                <path d="M14 3v5h5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span>العقود</span>
                    </a>
                    <a href="{{ route('legal-cases.index') }}"
                       class="flex items-center px-3 py-2 rounded-lg transition
                              {{ request()->routeIs('legal-cases.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="ml-3">
                            <!-- scale icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 3v3" stroke-width="1.6" stroke-linecap="round"/>
                                <path d="M5 7l3 7H2zM19 7l3 7h-6z" stroke-width="1.6" stroke-linejoin="round"/>
                                <path d="M4 21h16" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span>القضايا</span>
                    </a>
                    <a href="{{ route('legal-notices.index') }}"
                       class="flex items-center px-3 py-2 rounded-lg transition
                              {{ request()->routeIs('legal-notices.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="ml-3">
                            <!-- bell icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 3a5 5 0 00-5 5v2.5L5 14v1h14v-1l-2-3.5V8a5 5 0 00-5-5z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 19a2 2 0 004 0" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span>الإنذارات</span>
                    </a>

                    @if(auth()->user()?->isAdmin())
                        <a href="{{ route('users.index') }}"
                           class="flex items-center px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <span class="ml-3">
                                <!-- users icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <circle cx="9" cy="9" r="3" stroke-width="1.6"/>
                                    <circle cx="17" cy="9" r="3" stroke-width="1.6"/>
                                    <path d="M4 19a5 5 0 0110 0" stroke-width="1.6" stroke-linecap="round"/>
                                    <path d="M14 19a5 5 0 016-4.9" stroke-width="1.6" stroke-linecap="round"/>
                                </svg>
                            </span>
                            <span>المستخدمون</span>
                        </a>
                    @endif
                </nav>
                <div class="px-4 py-3 border-t border-gray-100 text-xs text-gray-400">
                    &copy; {{ date('Y') }} جميع الحقوق محفوظة
                </div>
            </aside>

            <!-- Main content -->
            <div class="flex-1 flex flex-col">
                <!-- Topbar (for mobile) -->
                <header class="md:hidden bg-white shadow">
                    <div class="px-4 py-3 flex items-center justify-between">
                        <div class="text-base font-semibold text-gray-800">
                            @yield('title', 'نظام إدارة العقود والقضايا')
                        </div>
                        <div class="flex items-center space-x-3 space-x-reverse text-gray-400 text-xs">
                            @auth
                                <span class="text-gray-700">{{ auth()->user()->name }}</span>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:underline">خروج</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">دخول</a>
                            @endauth
                        </div>
                    </div>
                </header>

                <!-- User bar (desktop) -->
                <div class="hidden md:flex justify-end items-center px-8 pt-4 text-xs text-gray-500 space-x-3 space-x-reverse">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:underline">
                            {{ auth()->user()->name }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:underline">تسجيل الخروج</button>
                        </form>
                    @endauth
                </div>

                <main class="px-4 md:px-8 py-6 md:py-4">
                    @if (session('success'))
                        <div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 border border-green-100 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    @endif
</body>
</html>

