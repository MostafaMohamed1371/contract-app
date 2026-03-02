<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\LegalCaseController;
use App\Http\Controllers\LegalNoticeController;
use App\Models\Contract;
use App\Models\LegalCase;
use App\Models\LegalNotice;

Route::get('/', function () {
    $contractsCount = Contract::count();
    $casesCount = LegalCase::count();
    $noticesCount = LegalNotice::count();

    $latestContracts = Contract::orderByDesc('id')->limit(5)->get();
    $upcomingHearings = LegalCase::whereNotNull('next_hearing_at')
        ->orderBy('next_hearing_at')
        ->limit(5)
        ->get();
    $latestNotices = LegalNotice::orderByDesc('id')->limit(5)->get();

    return view('dashboard', compact(
        'contractsCount',
        'casesCount',
        'noticesCount',
        'latestContracts',
        'upcomingHearings',
        'latestNotices'
    ));
})->name('dashboard');

Route::resource('contracts', ContractController::class);
Route::get('contracts/{contract}/file', [ContractController::class, 'downloadSignedPdf'])
    ->name('contracts.file');

Route::resource('legal-cases', LegalCaseController::class);
Route::resource('legal-notices', LegalNoticeController::class);
Route::get('legal-notices/{legalNotice}/attachment', [LegalNoticeController::class, 'downloadAttachment'])
    ->name('legal-notices.attachment');
