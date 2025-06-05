@extends('layouts.app')

@section('content')
    <h1>Calendar</h1>
    <ul>
        @foreach($events as $event)
            <li>
                <a href="{{ route('calendar.show', $event) }}">{{ $event->title }}</a>
                ({{ $event->start_at->format('Y-m-d H:i') }})
            </li>
        @endforeach
    </ul>
@endsection
