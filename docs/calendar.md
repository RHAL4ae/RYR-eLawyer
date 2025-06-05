# Unified Calendar and Notification System

This module demonstrates a basic implementation of calendar events with automatic
task generation and Laravel notifications. While simplified, it shows how hearings
and other key deadlines can trigger email, database, and broadcast notifications.

## Key Components

- **Models**: `CalendarEvent` and `Task`
- **Notifications**: `HearingNotification` and `DeadlineNotification`
- **Command**: `calendar:generate-deadline-tasks`
- **Views**: Basic Blade templates to list and view events

To generate tasks, run:

```sh
php artisan calendar:generate-deadline-tasks
```

This is only a skeleton; integrate it with your existing Laravel app for full functionality.
