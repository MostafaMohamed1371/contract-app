<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use Illuminate\Http\Request;

class LegalCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cases = LegalCase::orderByDesc('id')->paginate(15);

        return view('legal-cases.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('legal-cases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'case_number' => ['required', 'string', 'max:255', 'unique:legal_cases,case_number'],
            'file_number' => ['nullable', 'string', 'max:255'],
            'court' => ['required', 'string', 'max:255'],
            'case_type' => ['required', 'string', 'max:255'],
            'parties' => ['required', 'string'],
            'responsible_lawyer' => ['nullable', 'string', 'max:255'],
            'next_hearing_at' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        LegalCase::create($data);

        return redirect()->route('legal-cases.index')
            ->with('success', 'تم إنشاء القضية بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalCase $legalCase)
    {
        return view('legal-cases.show', ['case' => $legalCase]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalCase $legalCase)
    {
        return view('legal-cases.edit', ['case' => $legalCase]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LegalCase $legalCase)
    {
        $data = $request->validate([
            'case_number' => ['required', 'string', 'max:255', 'unique:legal_cases,case_number,' . $legalCase->id],
            'file_number' => ['nullable', 'string', 'max:255'],
            'court' => ['required', 'string', 'max:255'],
            'case_type' => ['required', 'string', 'max:255'],
            'parties' => ['required', 'string'],
            'responsible_lawyer' => ['nullable', 'string', 'max:255'],
            'next_hearing_at' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $legalCase->update($data);

        return redirect()->route('legal-cases.index')
            ->with('success', 'تم تحديث بيانات القضية بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalCase $legalCase)
    {
        $legalCase->delete();

        return redirect()->route('legal-cases.index')
            ->with('success', 'تم حذف القضية بنجاح.');
    }
}
