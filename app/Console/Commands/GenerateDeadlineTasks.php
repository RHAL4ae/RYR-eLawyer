<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CalendarEvent;
use App\Models\Task;

class GenerateDeadlineTasks extends Command
{
    protected $signature = 'calendar:generate-deadline-tasks';

    protected $description = 'Auto-generate tasks for statute of limitations and key legal deadlines.';

    public function handle(): int
    {
        // This is a placeholder implementation. In a real application, you would
        // calculate statute of limitations and other deadlines based on the
        // event type and create associated tasks.
        $events = CalendarEvent::where('type', 'hearing')->get();
        foreach ($events as $event) {
            Task::firstOrCreate([
                'calendar_event_id' => $event->id,
                'description' => 'Prepare for hearing: ' . $event->title,
                'due_at' => $event->start_at->subDays(1),
            ]);
        }

        $this->info('Deadline tasks generated.');
        return Command::SUCCESS;
    }
}
