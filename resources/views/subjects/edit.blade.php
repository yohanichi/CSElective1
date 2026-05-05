@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Edit Subject</h2>
        <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Update subject information</p>
    </div>

    <form method="POST" action="{{ route('subjects.update', $subject) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Subject Code *</label>
            <input type="text" id="code" name="code" value="{{ old('code', $subject->code) }}" required>
        </div>

        <div class="form-group">
            <label for="title">Subject Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $subject->title) }}" required>
        </div>

        <div class="form-group">
            <label for="unit">Units *</label>
            <input type="number" id="unit" name="unit" value="{{ old('unit', $subject->unit) }}" min="1" required>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
            <button type="submit" class="btn btn-primary">Update Subject</button>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection