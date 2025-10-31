<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <title>@yield('title')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Cal+Sans&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Erica+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Cal+Sans&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <a href="{{ url('') }}" class="logo">
            <div class="logo-pill">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="logo-img">
            </div>
        </a>
        <ul class="navbar">
            <li><a href="{{ url('') }}">Home</a></li>
            <li><a href="{{ url('/kasus') }}">Kasus</a></li>
            <li><a href="{{ url('/report') }}">Lapor</a></li>
            <li><a href="{{ url('/dangerous-phone-numbers/search') }}">Nomor Penipu</a></li>
            <li><a href="{{ url('/contacts') }}">Contacts</a></li>
        </ul>
        <div class="main">
            <a href="https://wensteintopup.com/" class="btn-header">
                <img src="{{ asset('images/ws-topup.png') }}" alt="User Icon">
                Top Up
            </a>
            <div class="bx bx-menu" id="menu-icon"></div>

        </div>
    </header>

    <body>
        <main>
            @yield('content')
        </main>
    </body>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <img src="/images/Logo.png" alt="Wenstein Store Logo" style="max-width: 120px; margin-bottom: 10px;">
                <p>Wenstein store adalah tempat top up games yang aman, murah dan terpercaya. Proses cepat 1-3 Detik.
                    Open 24 jam. Payment terlengkap. Jika ada kendala silahkan klik logo CS di bagian kanan bawah di
                    website ini.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><i class="fa-solid fa-arrow-right"></i><a href="/">Home</a></li>
                    <li><i class="fa-solid fa-arrow-right"></i><a href="/kasus">Kasus</a></li>
                    <li><i class="fa-solid fa-arrow-right"></i><a href="/report">Lapor</a></li>
                    <li><i class="fa-solid fa-arrow-right"></i><a href="/contacts">Contacts</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul>
                    <li><a href="https://wa.me/6285297976565"><i class="fa-brands fa-whatsapp"></i> 0852-9797-6565
                            (Admin Rekber)</a></li>
                    <li><a href="https://wa.me/089630503634" target="_blank"><i class="fa-brands fa-whatsapp"></i>
                            0896-3050-3634 (Admin Post)</a></li>
                    <li><a href="https://wa.me/6285257291585" target="_blank"><i class="fa-brands fa-whatsapp"></i>
                            0852-5729-1585 (Top Up)</a></li>
                    <li><a href="mailto:wensteinstore@gmail.com"><i class="fa-solid fa-envelope"></i>
                            wensteinstore@gmail.com</a></li>
                    <li><a href="https://instagram.com/wensteinstore" target="_blank"><i
                                class="fa-brands fa-instagram"></i> wensteinstore</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 Wenstein Store. All rights reserved.</p>
        </div>
    </footer>
    <style>
        /* Navbar Styles */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
            /* font-weight: 400; */
            /* font-style: normal; */
            text-decoration: none;
            list-style: none;
        }

        :root {
            --bg-color: rgb(255, 255, 255);
            --text-color: #F4B446;
            --main-color: #4E4E50
        }

        body {
            min-height: 100vh;
            background: var(--bg-color);
            color: var(--text-color);
            font-family: "Inter", sans-serif;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: transparent;
            padding: 28px 12%;
            transition: all .50s ease;

        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo i {
            color: var(--main-color);
            font-size: 28px;
            margin-right: 3px;
        }


        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .logo span {
            color: var(--text-color);
            font-size: 1.7rem;
            font-weight: 600;

        }

        .navbar {
            display: flex;
        }

        .navbar a {
            font-family: 'Cal Sans', sans-serif;
            color: var(--text-color);
            font-size: 1.1rem;
            font-weight: 600;
            padding: 5px 0;
            margin: 0px 30px;
            transition: all .50s ease;
            text-decoration: none;
            letter-spacing: 0.25rem;
            text-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .navbar a:hover {
            color: rgb(218, 157, 28);
            font-size: 1.5rem;
        }

        .navbar a.active {
            color: #F4B446;
            font-weight: 800;
        }

        .main {
            display: flex;
            align-items: center;

        }

        .main a {
            margin-right: 25px;
            margin-left: 10px;
            color: var(--text-color);
            font-size: 1.1rem;
            font-weight: 500;
            transition: all .50s ease;
        }

        .main .btn-header {
            position: relative;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            height: 60px;
            width: 200px;
            /* place-items: right; */
            margin: 0 35px;
            border-radius: 50px;
            border: none;
            outline: none;
            background-color: #;
            font-size: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            justify-content: center;
        }

        .btn-header img {
            width: 30px;
            /* Atur lebar gambar */
            height: auto;
            /* Biarkan tinggi otomatis untuk menjaga proporsi */
            margin-right: 8px;
            object-fit: contain;
            /* Menjaga proporsi gambar */
        }


        .main .a .span {
            text-align: center;
        }

        .main .btn-header:first-child:hover {
            background: linear-gradient(90deg, #fa7199, #f5ce62, #e43603, #fa7199);
            background-size: 400%;
        }

        .main .btn-header:first-child:before {
            content: '';
            position: absolute;
            background: inherit;
            top: -5px;
            right: -5px;
            bottom: -5px;
            left: -5px;
            border-radius: 50px;
            filter: blur(20px);
            opacity: 0;
            transition: opacity 0.5s;
            place-items: right;
        }

        .main .btn-header:first-child:hover:before {
            opacity: 1;
            z-index: -1;
        }

        .main .btn-header:hover {
            z-index: 1;
            animation: glow 8s linear infinite;
        }

        @keyframes glow {
            0% {
                background-position: 0%;
            }

            100% {
                background-position: 400%;
            }
        }

        .user {
            display: flex;
            align-items: center;
        }

        .user i {
            color: var(--main-color);
            font-size: 28px;
            margin-right: 7px;
        }

        .main a:hover {
            color: var(--main-color);
        }

        #menu-icon {
            font-size: 35px;
            color: var(--text-color);
            cursor: pointer;
            z-index: 10001;
            display: none;
        }

        @media (max-width: 1280px) {
            header {
                padding: 14px 2%;
                transition: .2s;
            }

            .navbar a {
                padding: 5px 0px;
                margin: 0px 20px;
            }
        }

        @media (max-width: 1090px) {
            #menu-icon {
                display: block;
                cursor: pointer;
                /* Menambahkan kursor pointer untuk interaksi */
            }

            .navbar {
                position: fixed;
                /* Mengubah posisi menjadi fixed agar tetap terlihat saat scroll */
                top: 0;
                /* Menempatkan navbar di atas */
                right: -300px;
                /* Menyembunyikan navbar di luar layar */
                width: 250px;
                /* Lebar sidebar */
                height: 100%;
                /* Mengisi tinggi layar */
                background: rgb(106, 106, 127);
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                /* Menyusun elemen dari atas ke bawah */
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
                /* Menambahkan bayangan untuk efek kedalaman */
                transition: right 0.3s ease;
                /* Memperhalus transisi */
                z-index: 1000;
                /* Memastikan navbar berada di atas elemen lain */
                padding: 20px;
                /* Menambahkan padding di dalam navbar */
            }

            .sidebar-logo {
                width: 100%;
                /* Memastikan logo mengambil lebar penuh */
                display: flex;
                justify-content: flex-end;
                /* Mengatur logo ke kanan */
                margin-bottom: 20px;
                /* Jarak antara logo dan link */
            }

            .navbar img.logo-img {
                height: 50px;
                /* Ukuran logo */
            }

            .navbar ul {
                list-style: none;
                /* Menghapus bullet points */
                padding: 0;
                /* Menghapus padding default */
                width: 100%;
                /* Memastikan ul mengambil lebar penuh */
                display: flex;
                flex-direction: column;
                /* Menyusun link secara vertikal */
                align-items: flex-end;
                /* Mengatur link ke kanan */
            }

            .navbar a {
                display: block;
                margin: 15px 0;
                /* Menambah jarak antar link */
                padding: 10px 20px;
                /* Menambah padding untuk link */
                color: white;
                /* Mengubah warna teks menjadi putih */
                text-decoration: none;
                /* Menghapus garis bawah */
                transition: background 0.3s ease;
                /* Memperhalus transisi latar belakang */
                width: 100%;
                /* Memastikan link mengambil lebar penuh */
                text-align: right;
                /* Mengatur teks ke kanan */
            }

            .navbar a:hover {
                background: rgba(255, 255, 255, 0.2);
                /* Menambahkan efek latar belakang saat hover */
                transform: translateY(-2px);
                /* Sedikit mengangkat link saat hover */
            }

            .navbar a.active {
                background: rgba(255, 255, 255, 0.3);
                /* Menandai link aktif dengan latar belakang */
            }

            .navbar.open {
                right: 0;
                /* Menampilkan navbar saat terbuka */
            }
        }



        footer {
            background-color: #333;
            color: white;
            padding: 40px 20px;
            font-size: 16px;
        }

        footer a {
            text-decoration: none;
            color: white;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: orange;
        }


        .footer-content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 40px 20px;
            margin: auto;
            gap: 170px;
            max-width: 1200px;
        }

        .footer-section {
            max-width: 300px;

        }

        .footer-section h3 {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .footer-section h3::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 110px;
            background: linear-gradient(to right, rgba(244, 180, 70, 0.3), #F4B446);
            border-radius: 2px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 1rem;
        }

        .footer-section i {
            margin-right: 10px;
            color: #F4B446;
        }

        .footer-section ul li a {
            color: #FFF;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer ul li a:hover {
            color: #F4B446;
        }

        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 1rem;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                gap: 40px;
            }

            .footer-section img {
                margin: 0 auto;
            }

            .footer-section ul li {
                justify-content: space-around;
            }
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .btn-header {
            display: flex;
            align-items: center;
            background-color: #F4B446;
            color: #ffffff !important;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .btn-header img {
            width: 30px;
            height: 22px;
            margin-right: 8px;
        }

        .btn-header:hover {
            background-color: #F4B446;
            color: #4E4E50;
            /* Warna hover */
        }

        @media (max-width: 1090px) {
            .btn-header {
                display: none;
            }
        }
    </style>
    <script>
        let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');

        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>


</html>