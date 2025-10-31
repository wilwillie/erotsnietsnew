@extends('layouts.admin')

@section('title', 'Admin - Add Contact Us Card')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Add Contact Us Card</h1>

    <form action="{{ route('admin.contact_us_cards.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link (optional)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}">
            @error('link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Add Card</button>
        <a href="{{ route('admin.contact_us_cards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
