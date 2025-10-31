@extends('layouts.admin')

@section('title', 'Admin - Add Dangerous Account')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Add New Dangerous Account</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dangerous_accounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="ml_id" class="form-label text-warning">ML ID</label>
            <input type="text" class="form-control" id="ml_id" name="ml_id" value="{{ old('ml_id') }}" required>
        </div>

        <div class="mb-3">
            <label for="server_id" class="form-label text-warning">Server ID</label>
            <input type="text" class="form-control" id="server_id" name="server_id" value="{{ old('server_id') }}">
        </div>

        <div class="mb-3">
            <label for="pelaku_nickname" class="form-label text-warning">Pelaku Nickname</label>
            <input type="text" class="form-control" id="pelaku_nickname" name="pelaku_nickname" value="{{ old('pelaku_nickname') }}">
        </div>

        <div class="mb-3">
            <label for="korban_nickname" class="form-label text-warning">Korban Nickname</label>
            <input type="text" class="form-control" id="korban_nickname" name="korban_nickname" value="{{ old('korban_nickname') }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_kejadian" class="form-label text-warning">Tanggal Kejadian</label>
            <input type="date" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}">
        </div>

        <div class="mb-3">
            <label for="bukti_kasus" class="form-label text-warning">Bukti Kasus (jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control" id="bukti_kasus" name="bukti_kasus" accept=".jpg,.jpeg,.png,.pdf">
        </div>

        <div class="mb-3">
            <label for="kronologi" class="form-label text-warning">Kronologi</label>
            <textarea class="form-control" id="kronologi" name="kronologi" rows="4">{{ old('kronologi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Add Dangerous Account</button>
        <a href="{{ route('admin.dangerous_accounts.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection

<style>
    .container {
        margin-top: 20px;
    }
</style>
