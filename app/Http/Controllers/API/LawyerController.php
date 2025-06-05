<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use Illuminate\Http\Request;

class LawyerController extends Controller
{
    public function index()
    {
        return Lawyer::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:lawyers,email',
            'phone' => 'nullable',
        ]);
        return Lawyer::create($data);
    }

    public function show(Lawyer $lawyer)
    {
        return $lawyer;
    }

    public function update(Request $request, Lawyer $lawyer)
    {
        $data = $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:lawyers,email,'.$lawyer->id,
            'phone' => 'nullable',
        ]);
        $lawyer->update($data);
        return $lawyer;
    }

    public function destroy(Lawyer $lawyer)
    {
        $lawyer->delete();
        return response()->noContent();
    }
}
