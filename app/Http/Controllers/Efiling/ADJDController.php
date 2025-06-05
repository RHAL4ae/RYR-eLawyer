<?php

namespace App\Http\Controllers\Efiling;

use App\Http\Controllers\Controller;
use App\Services\Efiling\ADJDService;
use Illuminate\Http\Request;

class ADJDController extends Controller
{
    protected ADJDService $service;

    public function __construct(ADJDService $service)
    {
        $this->service = $service;
    }

    public function submit(Request $request)
    {
        $data = $request->all();
        return response()->json($this->service->submitCase($data));
    }
}
