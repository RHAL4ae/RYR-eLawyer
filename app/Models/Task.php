<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'calendar_event_id',
        'description',
        'due_at',
        'completed_at',
    ];

    protected $dates = [
        'due_at',
        'completed_at',
    ];

    public function event()
    {
        return $this->belongsTo(CalendarEvent::class, 'calendar_event_id');
    }
}
