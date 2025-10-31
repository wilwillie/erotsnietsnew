@extends('layouts.user')

@section('title', 'Cek Nomor Telepon Berbahaya')

@section('content')
<div class="container py-5" style="margin-top: 100px;">
    <h1 class="mb-4 text-warning fw-bold">Cek Nomor Telepon Berbahaya</h1>

    <form action="{{ route('dangerous_phone_numbers.search') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group input-group-lg mb-3">
            <input type="text" placeholder="Masukan Nomor Telepon atau Kata Kunci" name="search" id="search" class="form-control" value="{{ old('search', $search ?? '') }}">
            <button type="submit" class="btn btn-warning">Cek</button>
        </div>
        @error('search')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

    </form>

    @isset($dangerousPhoneNumbers)
        @if($dangerousPhoneNumbers && !$notFound)
            <div class="card mb-4 p-3 bg-light rounded alert">
                <h4>Daftar Nomor Telepon Berbahaya</h4>
                <div class="row">
            @foreach($dangerousPhoneNumbers as $phone)
            <div class="col-12 col-md-6 col-lg-6 mb-3">
                <div class="card h-100 border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-kuning">{{ $phone->phone_number }}</h5>
                        <p class="card-text">{{ $phone->keterangan ?? '-' }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        Dilaporkan: {{ $phone->created_at->format('Y-m-d') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $dangerousPhoneNumbers->appends(['search' => $search])->links('pagination::bootstrap-5') }}
    </div>
        @endif
        
    @endisset

    @if(isset($notFound) && $notFound)
        <div class="alert alert-danger">
            Nomor telepon tidak ditemukan untuk input yang dimasukkan.
        </div>
    @endif
</div>
@endsection
<style>
    .container {
        margin-top: 100px;
    }

    h1.text-warning {
        color: #F4B446 !important;
    }

    .text-kuning {
        color: #F4B446 !important;
    }

    .border-warning {
        border-color: #F4B446 !important;
    }

    .btn-warning {
        background-color: #F4B446 !important;
        color: white !important;
    }
</style>
