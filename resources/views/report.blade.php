@extends('layouts.user')

@section('title', 'Lapor')

@section('content')

    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-5 px-4 px-md-4">
            <div class="card-body p-5 px-4 px-md-5"></div>
            <h1 class="mb-3 text-warning fw-bold text-center">LAPORKAN MASALAH AKUN KAMU LEWAT FORM INI</h1>

            @if(session('success'))
                <div class="mb-4 p-3 bg-success text-white rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-danger text-white rounded">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dangerous.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
                @csrf
                <div class="col-md-6">
                    <label for="ml_id" class="form-label fw-bold text-warning fs-5">ML ID <span
                            class="text-danger">*</span></label>
                    <input type="number" placeholder="Masukan ID Game" name="ml_id" id="ml_id" value="{{ old('ml_id') }}"
                        required class="form-control form-control-lg" />
                </div>
                <div class="col-md-6">
                    <label for="server_id" class="form-label fw-bold text-warning fs-5">Server ID <span
                            class="text-danger">*</span></label>
                    <input type="number" placeholder="Masukan ID Server" name="server_id" id="server_id"
                        value="{{ old('server_id') }}" required class="form-control form-control-lg" />
                </div>
                <div class="col-md-6">
                    <label for="pelaku_nickname" class="form-label fw-bold text-warning fs-5">Kontak Pelaku <span
                            class="text-danger">*</span></label>
                    <input type="number" placeholder="Kontak Pelaku" name="pelaku_nickname" id="pelaku_nickname" required
                        value="{{ old('pelaku_nickname') }}" class="form-control form-control-lg" />
                </div>
                <div class="col-md-6">
                    <label for="korban_nickname" class="form-label fw-bold text-warning fs-5">Kontak Korban <span
                            class="text-danger">*</span></label>
                    <input type="number" placeholder="Kontak Korban" name="korban_nickname" id="korban_nickname" required
                        value="{{ old('korban_nickname') }}" class="form-control form-control-lg" />
                </div>
                <div class="col-md-6">
                    <label for="tanggal_kejadian" class="form-label fw-bold text-warning fs-5">Tanggal Kejadian</label>
                    <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" required
                        value="{{ old('tanggal_kejadian') }}" max="{{ date('Y-m-d') }}"
                        class="form-control form-control-lg" />
                </div>
                <div class="col-md-6">
                    <label for="bukti_kasus" class="form-label fw-bold text-warning fs-5">Bukti Kasus (jpg, jpeg, png max
                        4MB)</label>
                    <input type="file" name="bukti_kasus[]" id="bukti_kasus" accept=".jpg,.jpeg,.png"
                        class="form-control form-control-lg" multiple />
                </div>
                <div class="col-12">
                    <label for="kronologi" class="form-label fw-bold text-warning fs-5">Kronologi</label>
                    <textarea placeholder="Jelaskan kronologi kasus disini" name="kronologi" id="kronologi" rows="4"
                        class="form-control">{{ old('kronologi') }}</textarea>
                </div>
                <div class="col-12 text-end mb-5">
                    <button type="submit" class="btn btn-warning text-black fw-semibold px-5 py-2">
                        <i class="bi bi-send me-1"></i> Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

<style>
    .container {
        margin-top: 100px;
    }

    h1.text-warning {
        color: #F4B446 !important;
    }

    label.form-label {
        color: #F4B446 !important;
    }

    button.btn-warning {
        background-color: #F4B446 !important;
    }

    button.btn-warning {
        color: white !important;
    }
</style>