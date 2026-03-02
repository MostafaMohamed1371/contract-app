<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::orderByDesc('id')->paginate(15);

        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'contract_number' => ['required', 'string', 'max:255', 'unique:contracts,contract_number'],
            'entity_name' => ['required', 'string', 'max:255'],
            'contract_type' => ['required', 'string', 'max:255'],
            'signed_at' => ['nullable', 'date'],
            'duration' => ['nullable', 'string', 'max:255'],
            'end_date' => ['nullable', 'date'],
            'amount' => ['nullable', 'numeric'],
            'status' => ['required', 'string', 'max:255'],
            'signed_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'notify_before_days' => ['nullable', 'integer', 'min:1'],
        ]);

        if ($request->hasFile('signed_pdf')) {
            $path = $request->file('signed_pdf')->store('contracts', 'public');
            $data['signed_pdf_path'] = $path;
        }

        if (! isset($data['notify_before_days'])) {
            $data['notify_before_days'] = 30;
        }

        Contract::create($data);

        return redirect()->route('contracts.index')
            ->with('success', 'تم إنشاء العقد بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'contract_number' => ['required', 'string', 'max:255', 'unique:contracts,contract_number,' . $contract->id],
            'entity_name' => ['required', 'string', 'max:255'],
            'contract_type' => ['required', 'string', 'max:255'],
            'signed_at' => ['nullable', 'date'],
            'duration' => ['nullable', 'string', 'max:255'],
            'end_date' => ['nullable', 'date'],
            'amount' => ['nullable', 'numeric'],
            'status' => ['required', 'string', 'max:255'],
            'signed_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'notify_before_days' => ['nullable', 'integer', 'min:1'],
        ]);

        if ($request->hasFile('signed_pdf')) {
            $path = $request->file('signed_pdf')->store('contracts', 'public');
            $data['signed_pdf_path'] = $path;
        }

        if (! isset($data['notify_before_days'])) {
            $data['notify_before_days'] = $contract->notify_before_days ?? 30;
        }

        $contract->update($data);

        return redirect()->route('contracts.index')
            ->with('success', 'تم تحديث بيانات العقد بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'تم حذف العقد بنجاح.');
    }

    /**
     * Download the signed PDF file for the given contract.
     */
    public function downloadSignedPdf(Contract $contract)
    {
        if (! $contract->signed_pdf_path || ! Storage::disk('public')->exists($contract->signed_pdf_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($contract->signed_pdf_path);
    }
}
