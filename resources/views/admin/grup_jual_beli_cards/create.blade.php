@extends('layouts.admin')

@section('title', 'Admin - Add New Grup Jual Beli Card')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Add New Grup Jual Beli Card</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.grup_jual_beli_cards.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link (optional)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Card</button>
        <a href="{{ route('admin.grup_jual_beli_cards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
