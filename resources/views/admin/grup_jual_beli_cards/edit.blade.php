@extends('layouts.admin')

@section('title', 'Admin - Edit Grup Jual Beli Card')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Edit Grup Jual Beli Card</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.grup_jual_beli_cards.update', $grupJualBeliCard) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $grupJualBeliCard->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $grupJualBeliCard->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            @if($grupJualBeliCard->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $grupJualBeliCard->image_path) }}" alt="{{ $grupJualBeliCard->title }}" style="width: 150px; height: auto;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link (optional)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $grupJualBeliCard->link) }}">
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Order</label>
            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $grupJualBeliCard->order) }}" min="0">
        </div>

        <button type="submit" class="btn btn-warning">Update Card</button>
        <a href="{{ route('admin.grup_jual_beli_cards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
