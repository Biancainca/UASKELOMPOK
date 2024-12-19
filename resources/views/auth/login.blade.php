@extends('layout.apps')

@section('title', 'Login')

@section('content')
<div class="container">
    <h2 class="my-4">Login</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
