<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: row;
            overflow-x: hidden;
            /* Prevent horizontal scroll */
        }

        .sidebar {
            width: 250px;
            background-color: #4E4E50;
            min-height: 100vh;
            color: white;
            padding-top: 1rem;
            transition: transform 0.3s ease;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1.25rem;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: rgb(99, 99, 100);
            color: #ffc107;
        }

        .content {
            flex-grow: 1;
            padding: 1rem 2rem;
            background-color: #f8f9fa;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        /* Burger icon styles */
        .burger {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #ffc107;
            background: none;
            border: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 1000;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content {
                padding: 1rem;
                margin-left: 0;
            }
            .burger {
                display: block;
            }
            body.sidebar-open {
                overflow: hidden;
            }
        }
        .close-sidebar {
            display: none;
            position: absolute;
            top: 5px;
            right: 15px;
            font-size: 2rem;
            color: #ffc107;
            background: none;
            border: none;
            cursor: pointer;
            z-index: 1100;
        }
        @media (max-width: 768px) {
            .close-sidebar {
                display: block;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 1050;
                /* higher than backdrop */
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
            }

            .toggle-sidebar {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1100;
                border: none;
                font-size: 1.5rem;
                background-color: #ffc107;
                color: #333;
                width: 40px;
                height: 40px;
                border-radius: 4px;
                cursor: pointer;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            }

            .content {
                padding: 1rem;
            }

            /* Add backdrop for sidebar */
            .sidebar-backdrop {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1040;
                display: none;
            }

            .sidebar-backdrop.active {
                display: block;
            }
        }

        .toggle-sidebar {
            display: none;
        }
    </style>
</head>
    <body>
        <div class="sidebar" id="sidebar">
            <button class="close-sidebar" id="closeSidebar" aria-label="Close sidebar">&times;</button>
            <h4 class="text-center mb-4">Admin Panel</h4>
            <a href="{{ route('admin.dangerous_accounts.index') }}" class="{{ request()->routeIs('admin.dangerous_accounts.*') ? 'active' : '' }}">Dangerous Accounts</a>
            <a href="{{ route('admin.dangerous_phone_numbers.index') }}" class="{{ request()->routeIs('admin.dangerous_phone_numbers.*') ? 'active' : '' }}">Dangerous Phone Numbers</a>
            <a href="{{ route('admin.grup_jual_beli_cards.index') }}" class="{{ request()->routeIs('admin.grup_jual_beli_cards.*') ? 'active' : '' }}">Grup Jual Beli Cards</a>
            <a href="{{ route('admin.contact_us_cards.index') }}" class="{{ request()->routeIs('admin.contact-us-cards.*') ? 'active' : '' }}">Contact Us Cards</a>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-4 px-3">
                @csrf
                <button type="submit" class="btn btn-warning w-100">Logout</button>
            </form>
        </div>
        <div class="content">
            <nav class="navbar navbar-expand navbar-custom mb-4">
                <div class="container-fluid d-flex align-items-center">
                    <button class="burger" id="burger" aria-label="Toggle sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="navbar-brand text-warning fw-bold ms-3">@yield('title', 'Admin Panel')</span>
                </div>
            </nav>
            @yield('content')
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const burger = document.getElementById('burger');
                const sidebar = document.getElementById('sidebar');
                const closeSidebar = document.getElementById('closeSidebar');
                burger.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                    document.body.classList.toggle('sidebar-open');
                });
                closeSidebar.addEventListener('click', function () {
                    sidebar.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                });
            });
        </script>
    </body>
</html>
