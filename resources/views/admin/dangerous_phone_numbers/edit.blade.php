@extends('layouts.admin')

@section('title', 'Admin - Edit Dangerous Phone Number')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Edit Dangerous Phone Number</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dangerous_phone_numbers.update', $dangerousPhoneNumber->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="phone_number" class="form-label text-warning">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $dangerousPhoneNumber->phone_number) }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label text-warning">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $dangerousPhoneNumber->keterangan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update Phone Number</button>
        <a href="{{ route('admin.dangerous_phone_numbers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
