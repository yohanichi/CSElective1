@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Change Password</h2>
        <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Update your account security</p>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Current Password *</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="form-group">
            <label for="new_password">New Password *</label>
            <input type="password" id="new_password" name="new_password" required>
            <small>Minimum 6 characters</small>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password *</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
            <button type="submit" class="btn btn-primary">Change Password</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection