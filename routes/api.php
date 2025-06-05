<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    ClientController,
    LawyerController,
    CourtController,
    CaseController,
    HearingController
};

Route::apiResource('clients', ClientController::class);
Route::apiResource('lawyers', LawyerController::class);
Route::apiResource('courts', CourtController::class);
Route::apiResource('cases', CaseController::class);
Route::apiResource('hearings', HearingController::class);
