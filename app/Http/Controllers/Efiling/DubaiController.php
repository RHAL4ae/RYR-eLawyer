<?php

namespace App\Http\Controllers\Efiling;

use App\Http\Controllers\Controller;
use App\Services\Efiling\DubaiService;
use Illuminate\Http\Request;

class DubaiController extends Controller
{
    protected DubaiService $service;

    public function __construct(DubaiService $service)
    {
        $this->service = $service;
    }

    public function submit(Request $request)
    {
        $data = $request->all();
        return response()->json($this->service->submitCase($data));
    }
}
