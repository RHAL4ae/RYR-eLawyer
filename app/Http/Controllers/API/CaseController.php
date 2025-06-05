<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CaseFile;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function index()
    {
        return CaseFile::with(['client','lawyer','court'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'client_id' => 'required|exists:clients,id',
            'lawyer_id' => 'required|exists:lawyers,id',
            'court_id' => 'required|exists:courts,id',
        ]);
        return CaseFile::create($data);
    }

    public function show(CaseFile $case)
    {
        return $case->load(['client','lawyer','court','hearings']);
    }

    public function update(Request $request, CaseFile $case)
    {
        $data = $request->validate([
            'title' => 'sometimes|required',
            'description' => 'nullable',
            'client_id' => 'sometimes|exists:clients,id',
            'lawyer_id' => 'sometimes|exists:lawyers,id',
            'court_id' => 'sometimes|exists:courts,id',
        ]);
        $case->update($data);
        return $case;
    }

    public function destroy(CaseFile $case)
    {
        $case->delete();
        return response()->noContent();
    }
}
