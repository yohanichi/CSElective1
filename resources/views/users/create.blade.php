@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Add New User</h2>
        <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Create a new system user</p>
    </div>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
            <label for="username">Username *</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="e.g., john_doe" required>
            <small>3-20 characters, alphanumeric and underscore only</small>
        </div>

        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" required>
            <small>Minimum 6 characters</small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password *</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="account_type">Account Type *</label>
            <select id="account_type" name="account_type" required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('account_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('account_type') == 'staff' ? 'selected' : '' }}>Admin Staff</option>
                <option value="teacher" {{ old('account_type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ old('account_type') == 'student' ? 'selected' : '' }}>Student</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection