@extends('layouts.app')

@section('title', 'Edit Program')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Edit Program</h2>
        <p style="color: #718096; margin-top: 0.5rem; font-size: 0.95rem;">Update program information</p>
    </div>

    <form method="POST" action="{{ route('programs.update', $program) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Program Code *</label>
            <input type="text" id="code" name="code" value="{{ old('code', $program->code) }}" required>
        </div>

        <div class="form-group">
            <label for="title">Program Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $program->title) }}" required>
        </div>

        <div class="form-group">
            <label for="years">Years *</label>
            <input type="number" id="years" name="years" value="{{ old('years', $program->years) }}" min="1" required>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
            <button type="submit" class="btn btn-primary">Update Program</button>
            <a href="{{ route('programs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection