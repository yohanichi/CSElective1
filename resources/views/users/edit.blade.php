@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Edit User</h2>
        <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Update user information</p>
    </div>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Username *</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
            <small>3-20 characters, alphanumeric and underscore only</small>
        </div>

        <div class="form-group">
            <label for="account_type">Account Type *</label>
            <select id="account_type" name="account_type" required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('account_type', $user->account_type) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('account_type', $user->account_type) == 'staff' ? 'selected' : '' }}>Admin Staff</option>
                <option value="teacher" {{ old('account_type', $user->account_type) == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ old('account_type', $user->account_type) == 'student' ? 'selected' : '' }}>Student</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection