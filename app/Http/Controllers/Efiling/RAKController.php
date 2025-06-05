<?php

namespace App\Http\Controllers\Efiling;

use App\Http\Controllers\Controller;
use App\Services\Efiling\RAKService;
use Illuminate\Http\Request;

class RAKController extends Controller
{
    protected RAKService $service;

    public function __construct(RAKService $service)
    {
        $this->service = $service;
    }

    public function submit(Request $request)
    {
        $data = $request->all();
        return response()->json($this->service->submitCase($data));
    }
}
