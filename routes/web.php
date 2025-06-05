<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaseController;

Route::get('/', function () {
    return redirect()->route('cases.index');
});

Route::resource('cases', CaseController::class)->only(['index','show']);
