@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-1">مرحباً بك 👋</h1>
        <p class="text-sm text-gray-500">
            نظرة سريعة على العقود، القضايا، والإنذارات القانونية في النظام.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between">
            <div>
                <div class="text-xs text-gray-400 mb-1">إجمالي العقود</div>
                <div class="text-2xl font-semibold text-gray-800">{{ $contractsCount }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M7 3h7l5 5v13H7z" stroke-width="1.6" stroke-linejoin="round"/>
                    <path d="M14 3v5h5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between">
            <div>
                <div class="text-xs text-gray-400 mb-1">إجمالي القضايا</div>
                <div class="text-2xl font-semibold text-gray-800">{{ $casesCount }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M12 3v3" stroke-width="1.6" stroke-linecap="round"/>
                    <path d="M5 7l3 7H2zM19 7l3 7h-6z" stroke-width="1.6" stroke-linejoin="round"/>
                    <path d="M4 21h16" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between">
            <div>
                <div class="text-xs text-gray-400 mb-1">إجمالي الإنذارات</div>
                <div class="text-2xl font-semibold text-gray-800">{{ $noticesCount }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M12 9v4" stroke-width="1.6" stroke-linecap="round"/>
                    <path d="M12 17h.01" stroke-width="1.6" stroke-linecap="round"/>
                    <path d="M12 3L3 19h18z" stroke-width="1.6" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-gray-800">أحدث العقود</h2>
                <a href="{{ route('contracts.index') }}" class="text-xs text-blue-600 hover:underline">عرض الكل</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse ($latestContracts as $contract)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-800">
                                {{ $contract->contract_number }} – {{ $contract->entity_name }}
                            </div>
                            <div class="text-xs text-gray-400">
                                نوع العقد: {{ $contract->contract_type }} • ينتهي في: {{ $contract->end_date ?? 'غير محدد' }}
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs
                                     {{ $contract->status === 'فعال' ? 'bg-emerald-50 text-emerald-700' :
                                        ($contract->status === 'منتهي' ? 'bg-gray-100 text-gray-700' : 'bg-red-50 text-red-700') }}">
                            {{ $contract->status }}
                        </span>
                    </div>
                @empty
                    <p class="py-6 text-sm text-gray-400 text-center">
                        لا توجد عقود مسجلة حتى الآن.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-gray-800">جلسات قادمة</h2>
                    <a href="{{ route('legal-cases.index') }}" class="text-xs text-blue-600 hover:underline">عرض الكل</a>
                </div>
                <div class="space-y-3">
                    @forelse ($upcomingHearings as $case)
                        <div class="border border-gray-100 rounded-lg px-3 py-2">
                            <div class="text-sm font-medium text-gray-800">
                                {{ $case->case_number }} – {{ $case->court }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $case->next_hearing_at }} • {{ $case->case_type }}
                            </div>
                        </div>
                    @empty
                        <p class="py-4 text-sm text-gray-400 text-center">
                            لا توجد جلسات قادمة مسجلة.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-gray-800">أحدث الإنذارات</h2>
                    <a href="{{ route('legal-notices.index') }}" class="text-xs text-blue-600 hover:underline">عرض الكل</a>
                </div>
                <div class="space-y-3">
                    @forelse ($latestNotices as $notice)
                        <div class="border border-gray-100 rounded-lg px-3 py-2">
                            <div class="text-sm font-medium text-gray-800">
                                {{ $notice->type }} – {{ $notice->recipient ?? 'بدون مستلم' }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $notice->sent_at ?? 'تاريخ غير محدد' }}
                            </div>
                        </div>
                    @empty
                        <p class="py-4 text-sm text-gray-400 text-center">
                            لا توجد إنذارات مسجلة حتى الآن.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

