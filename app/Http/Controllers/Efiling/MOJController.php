<?php

namespace App\Http\Controllers\Efiling;

use App\Http\Controllers\Controller;
use App\Services\Efiling\MOJService;
use Illuminate\Http\Request;

class MOJController extends Controller
{
    protected MOJService $service;

    public function __construct(MOJService $service)
    {
        $this->service = $service;
    }

    public function submit(Request $request)
    {
        $data = $request->all();
        return response()->json($this->service->submitCase($data));
    }
}
