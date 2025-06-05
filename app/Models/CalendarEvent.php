<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CalendarEvent extends Model
{
    use Notifiable;

    protected $fillable = [
        'title',
        'start_at',
        'end_at',
        'type',
    ];

    protected $dates = [
        'start_at',
        'end_at',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
