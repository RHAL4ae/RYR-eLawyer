@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('onboarding.store') }}" enctype="multipart/form-data">
    @csrf
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Domain</label>
    <input type="text" name="domain" required>
    <label>Logo</label>
    <input type="file" name="logo">
    <label>Admin Email</label>
    <input type="email" name="email" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
@endsection
