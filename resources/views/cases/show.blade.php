@extends('layout')

@section('content')
<h1>{{ $case->title }}</h1>
<p>{{ $case->description }}</p>
<p>Client: {{ $case->client->name }}</p>
<p>Lawyer: {{ $case->lawyer->name }}</p>
<p>Court: {{ $case->court->name }}</p>
<h2>Hearings</h2>
<ul>
    @foreach($case->hearings as $hearing)
        <li>{{ $hearing->scheduled_at }} - {{ $hearing->notes }}</li>
    @endforeach
</ul>
@endsection
