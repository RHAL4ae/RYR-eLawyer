<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\OnboardingController;

Route::get('register', [OnboardingController::class, 'create'])->name('onboarding.create');
Route::post('register', [OnboardingController::class, 'store'])->name('onboarding.store');
Route::get('register/success', [OnboardingController::class, 'success'])->name('onboarding.success');
