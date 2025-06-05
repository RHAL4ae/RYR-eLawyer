<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = CalendarEvent::all();
        return view('calendar.index', compact('events'));
    }

    public function show(CalendarEvent $event)
    {
        return view('calendar.show', compact('event'));
    }
}
