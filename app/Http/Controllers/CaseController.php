<?php

namespace App\Http\Controllers;

use App\Models\CaseFile;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function index()
    {
        $cases = CaseFile::with(['client','lawyer','court'])->get();
        return view('cases.index', compact('cases'));
    }

    public function show(CaseFile $case)
    {
        return view('cases.show', compact('case'));
    }
}
