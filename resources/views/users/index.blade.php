@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 class="card-title">Users</h2>
                <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Manage system users and permissions</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Created On</th>
                <th>Created By</th>
                <th>Updated On</th>
                <th>Updated By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><strong>{{ $user->username }}</strong></td>
                <td><span style="display: inline-block; padding: 0.35rem 0.75rem; background: #edf2f7; border-radius: 6px; font-size: 0.85rem; font-weight: 500; color: #4a5568;">{{ ucfirst($user->account_type) }}</span></td>
                <td>{{ $user->created_on ? $user->created_on->format('M d, Y') : 'N/A' }}</td>
                <td>{{ $user->createdBy ? $user->createdBy->username : 'N/A' }}</td>
                <td>{{ $user->updated_on ? $user->updated_on->format('M d, Y') : 'N/A' }}</td>
                <td>{{ $user->updatedBy ? $user->updatedBy->username : 'N/A' }}</td>
                <td class="actions" style="display: flex; gap: 0.5rem; align-items: center;">
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary btn-sm" style="white-space: nowrap;">Edit</a>
                    @if($user->id !== Auth::id())
                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" style="white-space: nowrap;" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="padding: 2rem; color: #a0aec0;">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 2.5rem;">
        <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
    </div>
</div>
@endsection