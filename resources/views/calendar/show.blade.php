@extends('layouts.app')

@section('content')
    <h1>{{ $event->title }}</h1>
    <p>Start: {{ $event->start_at->format('Y-m-d H:i') }}</p>
    <p>End: {{ optional($event->end_at)->format('Y-m-d H:i') }}</p>

    <h2>Tasks</h2>
    <ul>
        @foreach($event->tasks as $task)
            <li>{{ $task->description }} - due {{ $task->due_at->format('Y-m-d H:i') }}</li>
        @endforeach
    </ul>
@endsection
