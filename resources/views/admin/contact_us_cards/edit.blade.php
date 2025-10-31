@extends('layouts.admin')

@section('title', 'Admin - Edit Contact Us Card')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Edit Contact Us Card</h1>

    <form action="{{ route('admin.contact_us_cards.update', $contactUsCard) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $contactUsCard->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $contactUsCard->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            @if($contactUsCard->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $contactUsCard->image_path) }}" alt="{{ $contactUsCard->title }}" style="width: 150px; height: auto;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link (optional)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $contactUsCard->link) }}">
            @error('link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Order</label>
            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $contactUsCard->order ?? 0) }}" min="0">
            @error('order')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update Card</button>
        <a href="{{ route('admin.contact_us_cards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
