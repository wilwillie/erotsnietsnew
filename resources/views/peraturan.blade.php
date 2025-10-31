@extends('layouts.user')

@section('title', 'Peraturan Rekber Wenstein Store')

@section('content')
    <div class="container">
        <h1>PERATURAN REKBER <span class="highlight">WENSTEIN STORE</span></h1>

        <h2>Tahap Pertama</h2>
        <ol>
            <li>1. Penjual ketik <strong>"Saya Penjual"</strong></li>
            <li>2. Pembeli ketik <strong>"Saya Pembeli"</strong></li>
            <li>3. Sistem Reff (tergantung kesepakatan antara Penjual dan Pembeli)</li>
        </ol>

        <h2>Keterangan :</h2>
        <ul>
            <li>- <span class="italic">Tidak melayani rekber akun FF, Galver/Nosep/Unchek/Cheker, dsb.</span></li>
            <li>- <span class="italic">Hanya melayani Rekber Akun ML dengan Status Bind : Monsep (Email Akun Moonton
                    terkait, Akun Gmail aktif dan milik sendiri!)</span></li>
            <li>- <span class="italic">1 AKUN = 1x REKBER</span></li>
        </ul>

        <h2>Tahap Kedua</h2>
        <ol>
            <li>1. Penjual isi Formulir Rekber yang dikasih Admin</li>
            <li>2. Pembeli mengirimkan uang ke Admin</li>
            <li>3. Tunggu sampai Admin konfirmasi uangnya masuk/belum</li>
            <li>4. Jika sudah masuk lanjut ke proses Serah Terima Data Akun (nanti ada Tata Cara Penyerahan Akun)</li>
            <li>5. Penjual kirim bukti serah terima data akun ke grup</li>
            <li>6. Pembeli konfirmasi <strong>DONE</strong> apabila Akun sudah benar-benar aman</li>
            <li>7. Admin cairkan uang ke Penjual</li>
        </ol>

        <h2>Keterangan :</h2>
        <ul>
            <li>- <span class="italic">Rekber selesai, Admin lepas tanggung jawab</span></li>
            <li>- <span class="italic">Rekber cancel, fee tidak kembali/hangus</span></li>
            <li>- <span class="italic">Nipu/drama uang tidak kembali</span></li>
            <li>- <span class="italic">Ketahuan rekber selain akun, fee berlaku 2x lipat!</span></li>
        </ul>

        <p class="footer-note">Pastikan kamu sudah baca &amp; sepakat dengan peraturan di atas</p>

        <table>
            <thead>
                <tr>
                    <th>HARGA AKUN (Rp)</th>
                    <th>FEE REKBER (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0-100.000</td>
                    <td>5.000</td>
                </tr>
                <tr>
                    <td>100.001-250.000</td>
                    <td>10.000</td>
                </tr>
                <tr>
                    <td>250.001-500.000</td>
                    <td>15.000</td>
                </tr>
                <tr>
                    <td>500.001-700.000</td>
                    <td>20.000</td>
                </tr>
                <tr>
                    <td>700.001-1.000.000</td>
                    <td>30.000</td>
                </tr>
                <tr>
                    <td>1.000.001+</td>
                    <td>40.000</td>
                </tr>
            </tbody>
        </table>
    </div>

    <style>
        /* Styles specific to rekber page */
        .container {
            margin-top: 100px;
            margin-bottom: 40px;
            padding: 0 20px;
            color: #000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.25rem;
            background: #f4a742;
            color: #000;
            padding: 4px 10px;
            border-radius: 4px;
            user-select: none;
        }

        h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
            user-select: none;
        }

        .highlight {
            color: #f4a742;
        }

        h2 {
            font-weight: 600;
            font-size: 1.25rem;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        ol {
            padding-left: 20px;
            margin-top: 0;
            margin-bottom: 15px;
        }

        ol li {
            margin-bottom: 6px;
        }

        ul {
            padding-left: 20px;
            margin-top: 0;
            margin-bottom: 15px;
        }

        ul li {
            margin-bottom: 6px;
        }

        .italic {
            font-style: italic;
        }

        .bold {
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f4a742;
            border-radius: 8px;
            overflow: hidden;
            user-select: none;
        }

        th,
        td {
            padding: 10px 12px;
            text-align: left;
            color: #fff;
        }

        th {
            font-weight: 700;
            background-color: #f4a742;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .triangle {
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 15px solid #f4a742;
            margin: 10px 0;
            user-select: none;
        }

        .dots-grid {
            display: grid;
            grid-template-columns: repeat(3, 6px);
            grid-gap: 4px;
            margin-top: 10px;
            user-select: none;
        }

        .dot {
            width: 6px;
            height: 6px;
            background-color: #f4a742;
            border-radius: 50%;
        }

        .footer-note {
            margin-top: 20px;
            font-weight: 700;
            font-style: italic;
            user-select: none;
        }
    </style>
@endsection