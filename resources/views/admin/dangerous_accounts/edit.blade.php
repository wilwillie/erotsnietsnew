@extends('layouts.admin')

@section('title', 'Admin - Edit Dangerous Account')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-warning fw-bold">Edit Dangerous Account</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dangerous_accounts.update', $dangerousAccount->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ml_id" class="form-label text-warning">ML ID</label>
                <input type="text" class="form-control" id="ml_id" name="ml_id"
                    value="{{ old('ml_id', $dangerousAccount->ml_id) }}" required>
            </div>

            <div class="mb-3">
                <label for="server_id" class="form-label text-warning">Server ID</label>
                <input type="text" class="form-control" id="server_id" name="server_id"
                    value="{{ old('server_id', $dangerousAccount->server_id) }}">
            </div>

            <div class="mb-3">
                <label for="pelaku_nickname" class="form-label text-warning">Pelaku Nickname</label>
                <input type="text" class="form-control" id="pelaku_nickname" name="pelaku_nickname"
                    value="{{ old('pelaku_nickname', $dangerousAccount->pelaku_nickname) }}">
            </div>

            <div class="mb-3">
                <label for="korban_nickname" class="form-label text-warning">Korban Nickname</label>
                <input type="text" class="form-control" id="korban_nickname" name="korban_nickname"
                    value="{{ old('korban_nickname', $dangerousAccount->korban_nickname) }}">
            </div>

            <div class="mb-3">
                <label for="tanggal_kejadian" class="form-label text-warning">Tanggal Kejadian</label>
                <input type="date" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian"
                    value="{{ old('tanggal_kejadian', $dangerousAccount->tanggal_kejadian) }}">
            </div>

            <div class="mb-3">
                <label for="bukti_kasus" class="form-label text-warning">Bukti Kasus (jpg, jpeg, png, pdf)</label>
                @php
                    $buktiFiles = is_array($dangerousAccount->bukti_file_path) ? $dangerousAccount->bukti_file_path : json_decode($dangerousAccount->bukti_file_path, true);
                @endphp
                @if($buktiFiles && count($buktiFiles) > 0)
                    <p>Current bukti kasus:</p>
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        @foreach($buktiFiles as $file)
                            @php
                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                            @endphp
                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $file) }}" alt="Bukti Kasus"
                                    style="max-width: 200px; max-height: 150px; object-fit: contain;">
                            @elseif(strtolower($extension) === 'pdf')
                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                    class="btn btn-warning text-black fw-semibold">Lihat PDF</a>
                            @else
                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                    class="btn btn-warning text-black fw-semibold">Lihat File</a>
                            @endif
                        @endforeach
                    </div>
                @endif
                <input type="file" class="form-control" id="bukti_kasus" name="bukti_kasus" accept=".jpg,.jpeg,.png,.pdf">
                <small class="text-muted">Upload a new file to replace the current one.</small>
            </div>

            <div class="mb-3">
                <label for="kronologi" class="form-label text-warning">Kronologi</label>
                <textarea class="form-control" id="kronologi" name="kronologi"
                    rows="4">{{ old('kronologi', $dangerousAccount->kronologi) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="header_picture" class="form-label text-warning">Header Picture (jpg, jpeg, png)</label>
                @if($dangerousAccount->header_picture_path)
                    <p>Current header picture:</p>
                    <img src="{{ asset('storage/' . $dangerousAccount->header_picture_path) }}" alt="Header Picture"
                        style="max-width: 300px; max-height: 150px; object-fit: contain;">
                @endif
                <input type="file" class="form-control" id="header_picture" name="header_picture" accept=".jpg,.jpeg,.png">
                <small class="text-muted">Upload a new header picture to replace the current one.</small>
            </div>

            <button type="submit" class="btn btn-warning">Update Dangerous Account</button>
            <a href="{{ route('admin.dangerous_accounts.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
@endsection

<style>
    .container {
        margin-top: 20px;
    }
</style>