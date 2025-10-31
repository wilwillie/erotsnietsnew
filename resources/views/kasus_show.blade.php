@extends('layouts.user')

@section('title', 'Detail Kasus - ML ID: ' . $account->ml_id)

@section('content')
        <div class="container py-5">
            <h1 class="mb-4 text-warning fw-bold text-center">Detail Kasus - ML ID: {{ $account->ml_id }}</h1>

            <div class="card bg-dark text-white shadow-sm">
                <div class="card-body">
                    @if($account->header_picture_path)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $account->header_picture_path) }}" alt="Header Picture"
                                style="max-width: 100%; max-height: 300px; object-fit: contain; border-radius: 10px;">
                        </div>
                    @endif

                    <form class="case-details-form">
                        <div class="form-row">
                            <label for="created_at">Created At</label>
                            <input type="text" id="created_at" readonly
                                value="{{ \Carbon\Carbon::parse($account->created_at)->format('d-m-Y') }}">
                        </div>
                        <div class="form-row">
                            <label for="updated_at">Updated At</label>
                            <input type="text" id="updated_at" readonly
                                value="{{ \Carbon\Carbon::parse($account->updated_at)->format('d-m-Y') }}">
                        </div>
                        <div class="form-row">
                            <label for="ml_id">ML ID</label>
                            <input type="text" id="ml_id" readonly value="{{ $account->ml_id }}">
                        </div>
                        <div class="form-row">
                            <label for="server_id">Server ID</label>
                            <input type="text" id="server_id" readonly value="{{ $account->server_id }}">
                        </div>
                        <div class="form-row">
                            <label for="pelaku_nickname">Kontak Pelaku</label>
                            <input type="text" id="pelaku_nickname" readonly value="{{ $account->pelaku_nickname }}">
                        </div>
                        <div class="form-row">
                            <label for="korban_nickname">Kontak Korban</label>
                            <input type="text" id="korban_nickname" readonly value="{{ $account->korban_nickname }}">
                        </div>
                        <div class="form-row">
                            <label for="tanggal_kejadian">Tanggal Kejadian</label>
                            <input type="text" id="tanggal_kejadian" readonly
                                value="{{ \Carbon\Carbon::parse($account->tanggal_kejadian)->format('d-m-Y') }}">
                        </div>
                    </form>

                    <div class="mt-4">
                        <label class="d-block mb-2">Bukti Kasus:</label>
                        @php
    $buktiFiles = is_array($account->bukti_file_path) ? $account->bukti_file_path : json_decode($account->bukti_file_path, true);
                        @endphp
                        @if($buktiFiles && count($buktiFiles) > 0)
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($buktiFiles as $file)
                                    @php
            $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('storage/' . $file) }}" alt="Bukti Kasus" class="bukti-img">
                                    @elseif(strtolower($extension) === 'pdf')
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                            class="btn btn-warning text-black fw-semibold">Lihat PDF</a>
                                    @else
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                            class="btn btn-warning text-black fw-semibold">Lihat File</a>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>Tidak ada bukti kasus.</p>
                        @endif
                    </div>

                    <p class="mt-3"><strong>Kronologi:</strong> {{ $account->kronologi }}</p>
                    <a href="{{ route('dangerous.index') }}" class="btn btn-secondary mt-4">Kembali ke Daftar Kasus</a>
                </div>
            </div>
        </div>

        <style>
            .container {
                margin-top: 100px;
                max-width: 900px;
                background-color: #1e1e1e;
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(244, 180, 70, 0.4);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #f4b446;
            }

            h1.text-warning {
                text-shadow: 2px 2px 8px rgba(244, 180, 70, 0.9);
                font-size: 2.75rem;
                margin-bottom: 40px;
            }

            .case-details-form {
                display: flex;
                flex-wrap: wrap;
                gap: 1.5rem 3rem;
                margin-bottom: 2rem;
            }

            .form-row {
                display: flex;
                flex-direction: column;
                flex: 1 1 250px;
                max-width: 350px;
            }

            .form-row label {
                font-weight: 700;
                margin-bottom: 0.5rem;
                color: #f4b446;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
                font-size: 1.1rem;
            }

            .form-row input {
                padding: 10px 15px;
                font-size: 1rem;
                background-color: #2c2c2c;
                border: 1px solid #f4b446;
                border-radius: 8px;
                color: #f4b446;
                cursor: not-allowed;
                box-shadow: inset 0 0 5px rgba(244, 180, 70, 0.6);
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
            }

            .form-row input:focus {
                outline: none;
                border-color: #ffcc33;
                box-shadow: 0 0 8px #ffcc33;
            }

            .bukti-img {
                max-width: 200px;
                max-height: 200px;
                object-fit: contain;
                border-radius: 12px;
                box-shadow: 0 0 15px rgba(244, 180, 70, 0.8);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .bukti-img:hover {
                transform: scale(1.05);
                box-shadow: 0 0 25px rgba(244, 180, 70, 1);
            }

            p.mt-3 {
                font-size: 1.1rem;
                line-height: 1.6;
                margin-top: 2rem;
                color: #f4b446;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
            }

            a.btn.btn-secondary {
                background-color: #f4b446;
                color: #1e1e1e;
                font-weight: 600;
                padding: 12px 28px;
                border-radius: 10px;
                display: inline-block;
                box-shadow: 0 4px 12px rgba(244, 180, 70, 0.7);
                transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
            }

            a.btn.btn-secondary:hover {
                background-color: #e0a800;
                color: #fff;
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(224, 168, 0, 0.9);
                text-decoration: none;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .case-details-form {
                    flex-direction: column;
                    gap: 1.5rem 0;
                }

                .form-row {
                    max-width: 100%;
                }

                h1.text-warning {
                    font-size: 2rem;
                    margin-bottom: 30px;
                }
            }
        </style>
@endsection

