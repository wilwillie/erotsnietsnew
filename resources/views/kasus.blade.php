@extends('layouts.user')

@section('title', 'Kasus - Daftar Akun Berbahaya')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 fw-bold">Daftar Akun Berbahaya</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-4">
        <form method="GET" action="{{ route('dangerous.index') }}" class="d-flex align-items-center gap-2">
            <input type="number" name="search" class="form-control" placeholder="Masukkan ML ID..."
                value="{{ old('search', $search ?? '') }}">
            <button type="submit" class="btn btn-warning text-black fw-semibold px-4 py-2">Search</button>
        </form>
    </div>

        @if($dangerousAccounts->isEmpty())
            <p>Tidak ada akun berbahaya yang ditemukan.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($dangerousAccounts as $account)
                    <div class="col">
                        <div class="card bg-dark text-white h-100 d-flex align-items-center justify-content-center">
                            <div class="mb-4 text-center" style="width: 100%; height: 300px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $account->header_picture_path) }}" alt="Header Picture"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <div class="card-body text-center">
                                <h5 class="card-title">ML ID: {{ $account->ml_id }}</h5>
                                <h5 class="card-title">PUBLISH DATE:
                                    {{ \Carbon\Carbon::parse($account->created_at)->format('d-m-Y') }}</h5>
                                <a href="{{ route('dangerous.show', $account->ml_id) }}"
                                    class="btn custom-btn fw-semibold px-4 py-2 mt-3" style="color: white;">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<style>
    :root {
        --bg-color: rgb(255, 255, 255);
        --text-color: #F4B446;
        --main-color: #4E4E50
    }

    .container {
        margin-top: 100px;
        color: var(--text-color) !important;
    }

    .custom-btn {
        background-color: var(--text-color) !important;
        color: #000;
        border: none;
    }

    .custom-btn:hover {
        background-color: rgb(255, 187, 0) !important;
        color: #fff;
    }
</style>