<?php

namespace App\Http\Controllers;

use App\Models\LegalNotice;
use App\Models\Contract;
use App\Models\LegalCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegalNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = LegalNotice::orderByDesc('id')->paginate(15);

        return view('legal-notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contracts = Contract::orderBy('contract_number')->get();
        $cases = LegalCase::orderBy('case_number')->get();

        return view('legal-notices.create', compact('contracts', 'cases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'contract_id' => ['nullable', 'exists:contracts,id'],
            'legal_case_id' => ['nullable', 'exists:legal_cases,id'],
            'sent_at' => ['nullable', 'date'],
            'recipient' => ['required', 'string', 'max:255'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:5120'],
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('notices', 'public');
            $data['attachment_path'] = $path;
        }

        LegalNotice::create($data);

        return redirect()->route('legal-notices.index')
            ->with('success', 'تم إنشاء الإشعار بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalNotice $legalNotice)
    {
        return view('legal-notices.show', ['notice' => $legalNotice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalNotice $legalNotice)
    {
        $contracts = Contract::orderBy('contract_number')->get();
        $cases = LegalCase::orderBy('case_number')->get();

        return view('legal-notices.edit', [
            'notice' => $legalNotice,
            'contracts' => $contracts,
            'cases' => $cases,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LegalNotice $legalNotice)
    {
        $data = $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'contract_id' => ['nullable', 'exists:contracts,id'],
            'legal_case_id' => ['nullable', 'exists:legal_cases,id'],
            'sent_at' => ['nullable', 'date'],
            'recipient' => ['required', 'string', 'max:255'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:5120'],
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('notices', 'public');
            $data['attachment_path'] = $path;
        }

        $legalNotice->update($data);

        return redirect()->route('legal-notices.index')
            ->with('success', 'تم تحديث الإشعار بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalNotice $legalNotice)
    {
        $legalNotice->delete();

        return redirect()->route('legal-notices.index')
            ->with('success', 'تم حذف الإشعار بنجاح.');
    }

    /**
     * Download the attachment for the given notice.
     */
    public function downloadAttachment(LegalNotice $legalNotice)
    {
        if (! $legalNotice->attachment_path || ! Storage::disk('public')->exists($legalNotice->attachment_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($legalNotice->attachment_path);
    }
}
