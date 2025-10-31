@extends('layouts.user')

@section('title', 'Cek ID Akun')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Cek ID Akun</h1>

    <form action="{{ route('dangerous.cekIdSubmit') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">Masukkan ID Akun</label>
            <input type="text" name="id" id="id" class="form-control" value="{{ old('id', $inputId ?? '') }}" required>
            @error('id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-warning">Cek</button>
    </form>

    @isset($dangerousAccount)
        @if($dangerousAccount)
            <div class="card mb-4 p-3 bg-light border border-warning rounded alert">
                <h4>Detail Akun Berbahaya</h4>
                <p><strong>ML ID:</strong> {{ $dangerousAccount->ml_id }}</p>
                <p><strong>Server ID:</strong> {{ $dangerousAccount->server_id ?? '-' }}</p>
                <p><strong>Pelaku Nickname:</strong> {{ $dangerousAccount->pelaku_nickname ?? '-' }}</p>
                <p><strong>Korban Nickname:</strong> {{ $dangerousAccount->korban_nickname ?? '-' }}</p>
                <p><strong>Tanggal Kejadian:</strong> {{ $dangerousAccount->tanggal_kejadian ?? '-' }}</p>
                <p><strong>Kronologi:</strong> {{ $dangerousAccount->kronologi ?? '-' }}</p>
                @if($dangerousAccount->bukti_file_path)
                    <p><strong>Bukti File:</strong> <a href="{{ asset('storage/' . $dangerousAccount->bukti_file_path) }}" target="_blank">Lihat Bukti</a></p>
                @else
                    <p><strong>Bukti File:</strong> Tidak ada bukti file.</p>
                @endif
            </div>
        @else
            <div class="alert alert-danger">
                ML ID tidak ditemukan untuk ID yang dimasukkan.
            </div>
        @endif
    @endisset
</div>
@endsection

<style>
    .container {
        margin-top: 100px;
    }
</style>