@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card" style="max-width: 420px; margin: 3rem auto;">
    <div class="card-header text-center" style="border-bottom: none; margin-bottom: 2rem;">
        <h2 class="card-title" style="font-size: 2rem;">Welcome Back</h2>
        <p style="color: #718096; margin-top: 0.5rem;">Sign in to your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem;">Sign In</button>
        </div>
    </form>
</div>
@endsection