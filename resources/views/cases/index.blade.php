@extends('layout')

@section('content')
<h1>Cases</h1>
<ul>
    @foreach($cases as $case)
        <li><a href="{{ route('cases.show', $case) }}">{{ $case->title }}</a></li>
    @endforeach
</ul>
@endsection
