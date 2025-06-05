<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hearing;
use Illuminate\Http\Request;

class HearingController extends Controller
{
    public function index()
    {
        return Hearing::with('case')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'case_id' => 'required|exists:cases,id',
            'scheduled_at' => 'required|date',
            'notes' => 'nullable',
        ]);
        return Hearing::create($data);
    }

    public function show(Hearing $hearing)
    {
        return $hearing->load('case');
    }

    public function update(Request $request, Hearing $hearing)
    {
        $data = $request->validate([
            'case_id' => 'sometimes|exists:cases,id',
            'scheduled_at' => 'sometimes|date',
            'notes' => 'nullable',
        ]);
        $hearing->update($data);
        return $hearing;
    }

    public function destroy(Hearing $hearing)
    {
        $hearing->delete();
        return response()->noContent();
    }
}
