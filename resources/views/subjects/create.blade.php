@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Add New Subject</h2>
        <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Create a new course subject</p>
    </div>

    <form method="POST" action="{{ route('subjects.store') }}">
        @csrf

        <div class="form-group">
            <label for="code">Subject Code *</label>
            <input type="text" id="code" name="code" value="{{ old('code') }}" placeholder="e.g., MATH101" required>
        </div>

        <div class="form-group">
            <label for="title">Subject Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g., Calculus I" required>
        </div>

        <div class="form-group">
            <label for="unit">Units *</label>
            <input type="number" id="unit" name="unit" value="{{ old('unit') }}" min="1" placeholder="3" required>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
            <button type="submit" class="btn btn-primary">Create Subject</button>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection