<?php

use Illuminate\Support\Facades\Route;
<<<<<<< codex/implement-unified-calendar-and-notifications
use App\Http\Controllers\CalendarController;

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/{event}', [CalendarController::class, 'show'])->name('calendar.show');
=======
use App\Http\Controllers\CaseController;

Route::get('/', function () {
    return redirect()->route('cases.index');
});

Route::resource('cases', CaseController::class)->only(['index','show']);
>>>>>>> main
