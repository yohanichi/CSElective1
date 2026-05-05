@extends('layouts.app')

@section('title', 'Subjects')

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 class="card-title">Subjects</h2>
                <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Manage your course subjects</p>
            </div>
            @if(Auth::user()->canManageSubjectsPrograms())
            <a href="{{ route('subjects.create') }}" class="btn btn-primary">Add New Subject</a>
            @endif
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Title</th>
                <th>Units</th>
                @if(Auth::user()->canManageSubjectsPrograms())
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
            <tr>
                <td>{{ $subject->subject_id }}</td>
                <td><strong>{{ $subject->code }}</strong></td>
                <td>{{ $subject->title }}</td>
                <td>{{ $subject->unit }}</td>
                @if(Auth::user()->canManageSubjectsPrograms())
                <td class="actions" style="display: flex; gap: 0.5rem; align-items: center;">
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-secondary btn-sm" style="white-space: nowrap;">Edit</a>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="{{ Auth::user()->canManageSubjectsPrograms() ? '5' : '4' }}" class="text-center" style="padding: 2rem; color: #a0aec0;">No subjects found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 2.5rem;">
        <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
    </div>
</div>
@endsection