@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="text-center mb-3">
    <h1>School Management System</h1>
    <p class="mb-3">Welcome back! Manage your academic programs and courses</p>
</div>

<div class="grid">
    <div class="grid-item">
        <h3>Subjects</h3>
        <p>Organize and manage course subjects</p>
        <a href="{{ route('subjects.index') }}" class="btn btn-primary">View Subjects</a>
    </div>

    <div class="grid-item">
        <h3>Programs</h3>
        <p>Manage academic programs</p>
        <a href="{{ route('programs.index') }}" class="btn btn-primary">View Programs</a>
    </div>

    <div class="grid-item">
        <h3>Security</h3>
        <p>Update your account password</p>
        <a href="{{ route('password.edit') }}" class="btn btn-secondary">Change Password</a>
    </div>

    @if(Auth::user()->isAdmin())
    <div class="grid-item">
        <h3>Users</h3>
        <p>Manage system users and permissions</p>
        <a href="{{ route('users.index') }}" class="btn btn-primary">Manage Users</a>
    </div>
    @endif
</div>
@endsection