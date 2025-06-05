<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        return Court::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
        ]);
        return Court::create($data);
    }

    public function show(Court $court)
    {
        return $court;
    }

    public function update(Request $request, Court $court)
    {
        $data = $request->validate([
            'name' => 'sometimes|required',
            'location' => 'nullable',
        ]);
        $court->update($data);
        return $court;
    }

    public function destroy(Court $court)
    {
        $court->delete();
        return response()->noContent();
    }
}
