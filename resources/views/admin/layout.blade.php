<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SweetCake')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            background: linear-gradient(135deg, #fff5fa 0%, #ffe6f2 50%, #fff5fa 100%);
            background-attachment: fixed;
            color: #333;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 105, 180, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 77, 138, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255, 182, 193, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* =============== SIDEBAR =============== */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 270px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-right: 1px solid rgba(255, 105, 180, 0.2);
            box-shadow: 
                4px 0 32px rgba(255, 105, 180, 0.15),
                inset -1px 0 0 rgba(255, 255, 255, 0.8);
            padding: 26px 20px;
            border-radius: 0 24px 24px 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar:hover {
            box-shadow: 
                4px 0 40px rgba(255, 105, 180, 0.25),
                inset -1px 0 0 rgba(255, 255, 255, 0.9);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 105, 180, 0.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 105, 180, 0.5);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 40px;
            padding: 16px;
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1));
            border-radius: 16px;
            border: 1px solid rgba(255, 105, 180, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .brand::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 105, 180, 0.2);
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.15), rgba(255, 105, 180, 0.15));
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            background: linear-gradient(135deg, #ffb6c1 0%, #ff69b4 50%, #ff4d8a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 
                0 8px 24px rgba(255, 105, 180, 0.4),
                0 4px 12px rgba(255, 105, 180, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(5deg); }
        }

        .brand-logo:hover {
            transform: translateY(-4px) scale(1.05) rotate(5deg);
            box-shadow: 
                0 12px 32px rgba(255, 105, 180, 0.5),
                0 6px 16px rgba(255, 105, 180, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            animation: none;
        }

        .brand-logo::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #ffb6c1, #ff69b4, #ff4d8a, #ff1c78);
            border-radius: 18px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
            filter: blur(8px);
        }

        .brand-logo:hover::after {
            opacity: 0.6;
        }

        .brand-name {
            font-weight: 800;
            font-size: 22px;
            background: linear-gradient(135deg, #ff69b4 0%, #ff4d8a 50%, #ff1c78 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(255, 105, 180, 0.1);
            transition: all 0.3s ease;
        }

        .brand:hover .brand-name {
            background: linear-gradient(135deg, #ff1c78 0%, #ff4d8a 50%, #ff69b4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .menu {
            margin-top: 10px;
        }

        .menu .section-title {
            margin: 24px 0 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #999;
            font-weight: 700;
            padding-left: 14px;
            position: relative;
        }

        .menu .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 12px;
            background: linear-gradient(135deg, var(--pink-300), var(--pink-400));
            border-radius: 2px;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            text-decoration: none;
            color: #555;
            margin: 6px 0;
            border-radius: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-size: 14px;
            position: relative;
            overflow: hidden;
        }

        .menu a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, var(--pink-400), var(--pink-500));
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0 4px 4px 0;
        }

        .menu a::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 14px;
        }

        .menu a:hover {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.15), rgba(255, 105, 180, 0.15));
            color: var(--pink-500);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.15);
        }

        .menu a:hover i {
            transform: scale(1.2);
            color: var(--pink-500);
        }

        .menu a:hover::before {
            transform: scaleY(1);
        }

        .menu a:hover::after {
            opacity: 1;
        }

        .menu a.active {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.2), rgba(255, 105, 180, 0.2));
            color: var(--pink-500);
            font-weight: 700;
            border-left: 4px solid var(--pink-400);
            padding-left: 12px;
            box-shadow: 
                0 4px 12px rgba(255, 105, 180, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
            transform: translateX(2px);
        }

        .menu a.active i {
            color: var(--pink-500);
            transform: scale(1.1);
        }

        .menu a.active::before {
            transform: scaleY(1);
        }

        .menu a.active::after {
            opacity: 1;
        }

        /* =============== MAIN AREA =============== */
        .main {
            margin-left: 270px;
            padding: 34px;
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 20px 28px;
            border-radius: 20px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.08),
                0 2px 8px rgba(255, 105, 180, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 105, 180, 0.1);
            transition: all 0.3s ease;
        }

        header:hover {
            box-shadow: 
                0 12px 40px rgba(0, 0, 0, 0.1),
                0 4px 12px rgba(255, 105, 180, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
        }

        .welcome {
            color: var(--pink-400);
            font-weight: 800;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            text-shadow: 0 2px 4px rgba(255, 105, 180, 0.1);
        }

        .welcome::before {
            content: '✨';
            font-size: 20px;
            animation: sparkle 2s ease-in-out infinite;
        }

        @keyframes sparkle {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 1; }
            50% { transform: scale(1.2) rotate(180deg); opacity: 0.8; }
        }

        .btn {
            background: linear-gradient(135deg, var(--pink-400) 0%, var(--pink-500) 50%, var(--pink-400) 100%);
            background-size: 200% 200%;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 
                0 4px 16px rgba(255, 77, 138, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 8px 24px rgba(255, 77, 138, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            background-position: 100% 0;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:active {
            transform: translateY(-1px) scale(0.98);
        }

        /* =============== PANEL =============== */
        .panel {
            margin-top: 26px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.08),
                0 2px 8px rgba(255, 105, 180, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            padding: 24px;
            border: 1px solid rgba(255, 105, 180, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .panel:hover {
            box-shadow: 
                0 12px 40px rgba(0, 0, 0, 0.1),
                0 4px 12px rgba(255, 105, 180, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
        }

        .panel h3 {
            margin: 0 0 18px;
            color: var(--pink-400);
            font-weight: 800;
            font-size: 24px;
            position: relative;
            padding-bottom: 12px;
        }

        .panel h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--pink-400), var(--pink-500));
            border-radius: 2px;
        }

        /* =============== TABLE =============== */
        table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
        }

        th {
            text-align: left;
            padding: 14px 12px;
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(255, 182, 193, 0.3);
            font-weight: 700;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.05), rgba(255, 105, 180, 0.05));
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid rgba(243, 243, 243, 0.8);
            color: #444;
            transition: all 0.2s ease;
        }

        tr {
            transition: all 0.2s ease;
        }

        tr:hover {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.08), rgba(255, 105, 180, 0.08));
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.1);
        }

        tr:hover td {
            border-bottom-color: rgba(255, 182, 193, 0.3);
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
            .sidebar { 
                width: 220px; 
                border-radius: 0 20px 20px 0;
            }
            .main { margin-left: 220px; }
            .brand-logo {
                width: 50px;
                height: 50px;
                font-size: 28px;
            }
            .brand-name {
                font-size: 18px;
            }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Selection color */
        ::selection {
            background: rgba(255, 105, 180, 0.3);
            color: #333;
        }

        ::-moz-selection {
            background: rgba(255, 105, 180, 0.3);
            color: #333;
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
               <i class="fas fa-home"></i>
               <span style="margin-left: 12px;">Dashboard</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
               <i class="fas fa-shopping-cart"></i>
               <span style="margin-left: 12px;">Pesanan Masuk</span>
            </a>

            <a href="{{ route('admin.products.index') }}" 
               class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
               <i class="fas fa-box"></i>
               <span style="margin-left: 12px;">Mengelola Produk</span>
            </a>

            <div class="section-title">Lainnya</div>

            <a href="{{ route('admin.notifications.index') }}" 
               class="{{ request()->routeIs('admin.notifications.index') ? 'active' : '' }}">
               <i class="fas fa-bell"></i>
               <span style="margin-left: 12px;">Notifikasi</span>
            </a>

            <a href="{{ route('admin.reports.index') }}" 
               class="{{ request()->routeIs('admin.reports.index') ? 'active' : '' }}">
               <i class="fas fa-chart-line"></i>
               <span style="margin-left: 12px;">Laporan</span>
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
