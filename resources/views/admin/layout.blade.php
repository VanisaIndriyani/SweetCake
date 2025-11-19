<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SweetCake')</title>

    <style>
        :root {
            --pink-50:  #fff5fa;
            --pink-100: #ffe6f2;
            --pink-200: #ffb6c1;
            --pink-300: #ff69b4;
            --pink-400: #ff4d8a;
            --pink-500: #ff1c78;
            --bg: #fafafb;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: #333;
        }

        /* =============== SIDEBAR =============== */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 270px;
            height: 100vh;
            background: #fff;
            backdrop-filter: blur(6px);
            border-right: 1px solid #ffe3ec;
            box-shadow: 4px 0 24px rgba(255, 105, 180, 0.15);
            padding: 26px 20px;
            border-radius: 0 18px 18px 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 32px;
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--pink-200), var(--pink-300));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 24px rgba(255,105,180,.35);
        }

        .brand-name {
            font-weight: 800;
            font-size: 20px;
            background: linear-gradient(135deg, var(--pink-300), var(--pink-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .menu {
            margin-top: 10px;
        }

        .menu .section-title {
            margin: 20px 0 6px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #999;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 12px 14px;
            text-decoration: none;
            color: #444;
            margin: 4px 0;
            border-radius: 12px;
            transition: all .25s;
            font-weight: 600;
        }

        .menu a:hover {
            background: var(--pink-50);
            color: var(--pink-400);
        }

        .menu a.active {
            background: var(--pink-100);
            color: var(--pink-500);
            font-weight: 700;
            border-left: 4px solid var(--pink-400);
            padding-left: 10px;
        }

        /* =============== MAIN AREA =============== */
        .main {
            margin-left: 270px;
            padding: 34px;
        }

        header {
            background: #fff;
            padding: 18px 22px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome {
            color: var(--pink-400);
            font-weight: 800;
            font-size: 17px;
        }

        .btn {
            background: linear-gradient(135deg, var(--pink-400), var(--pink-500));
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            transition: .25s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255,70,140,0.35);
        }

        /* =============== PANEL =============== */
        .panel {
            margin-top: 26px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,.05);
            padding: 20px;
        }

        .panel h3 {
            margin: 0 0 14px;
            color: var(--pink-400);
            font-weight: 800;
        }

        /* =============== TABLE =============== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 10px;
            font-size: 12px;
            color: #777;
            text-transform: uppercase;
            border-bottom: 2px solid #ffe6f2;
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid #f3f3f3;
            color: #444;
        }

        tr:hover {
            background: var(--pink-50);
        }

        /* STATUS BADGE */
        .status {
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .status.baru {
            background: #ffe6f2;
            color: var(--pink-400);
        }

        .status.diproses {
            background: #fff3cd;
            color: #c29000;
        }

        .status.selesai {
            background: #d1f3e3;
            color: #0f5132;
        }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .main { padding: 20px; }
        }

        @media (max-width: 760px) {
            .sidebar { width: 220px; }
            .main { margin-left: 220px; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo">🧁</div>
            <div class="brand-name">SweetCake Admin</div>
        </div>

        <nav class="menu">
            <div class="section-title">Menu</div>

            <a href="{{ route('admin.dashboard') }}" 
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
               Dashboard
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
               Pesanan Masuk
            </a>

            <a href="{{ route('admin.products.index') }}" 
               class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
               Mengelola Produk
            </a>

            <div class="section-title">Lainnya</div>

            <a href="{{ route('admin.notifications.index') }}" 
               class="{{ request()->routeIs('admin.notifications.index') ? 'active' : '' }}">
               Notifikasi
            </a>

            <a href="{{ route('admin.reports.index') }}" 
               class="{{ request()->routeIs('admin.reports.index') ? 'active' : '' }}">
               Laporan
            </a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <header>
            <div class="welcome">Halo, {{ Auth::user()->nama }} 👋</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn" type="submit">Logout</button>
            </form>
        </header>

        @yield('content')

    </main>

</body>
</html>
