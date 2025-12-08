<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Saya - SweetCake</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --pink-100: #ffe6f2;
            --pink-200: #ffb6c1;
            --pink-300: #ff69b4;
            --pink-400: #ff4d8a;
            --pink-500: #ff1493;
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
        /* Navbar */
        .nav {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 105, 180, 0.2);
            box-shadow: 0 4px 20px rgba(255, 105, 180, 0.1);
            z-index: 1000;
        }
        .nav-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            color: var(--pink-400);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-brand:hover {
            transform: scale(1.05);
        }
        .nav-brand i {
            font-size: 24px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-4px) rotate(5deg); }
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .link {
            color: var(--pink-400);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }
        .link:hover {
            background: var(--pink-100);
            transform: translateY(-2px);
        }
        .icon-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid var(--pink-300);
            color: var(--pink-400);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .icon-btn:hover {
            background: var(--pink-100);
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }
        .badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, var(--pink-400), var(--pink-500));
            color: #fff;
            border-radius: 999px;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 800;
            box-shadow: 0 2px 8px rgba(255, 77, 138, 0.4);
        }
        .dropdown {
            position: relative;
        }
        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 50px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(255, 105, 180, 0.25);
            min-width: 200px;
            display: none;
            overflow: hidden;
            animation: fadeIn 0.3s ease;
            z-index: 1000;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .dropdown-menu a:hover {
            background: var(--pink-100);
            color: var(--pink-400);
            padding-left: 20px;
        }
        .dropdown.open .dropdown-menu {
            display: block;
        }
        .dropdown-menu form {
            margin: 0;
        }
        .dropdown-menu button {
            width: 100%;
            padding: 12px 16px;
            border: none;
            background: #fff;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .dropdown-menu button:hover {
            background: var(--pink-100);
            color: var(--pink-400);
            padding-left: 20px;
        }
        /* Layout */
        .container {
            max-width: 1100px;
            margin: 32px auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }
        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .page-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--pink-400);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-title i {
            font-size: 30px;
        }
        .muted {
            color: #666;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn {
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--pink-400), var(--pink-500));
            color: #fff;
            box-shadow: 0 4px 16px rgba(255, 77, 138, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(255, 77, 138, 0.4);
        }
        .btn-outline {
            background: #fff;
            color: var(--pink-400);
            border: 2px solid var(--pink-300);
        }
        .btn-outline:hover {
            background: var(--pink-100);
            border-color: var(--pink-400);
            transform: translateY(-2px);
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 10px 40px rgba(255, 105, 180, 0.15);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 50px rgba(255, 105, 180, 0.25);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--pink-400);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-title i {
            font-size: 20px;
        }
        .card-date {
            font-size: 13px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .card-date i {
            color: var(--pink-400);
        }
        .card-body {
            color: #555;
            line-height: 1.7;
            padding: 12px 0;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        .card-body::before {
            content: '';
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, var(--pink-300), var(--pink-400));
            border-radius: 2px;
            flex-shrink: 0;
        }
        .status {
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
            margin-left: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .status.baru {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #0d47a1;
        }
        .status.diproses {
            background: linear-gradient(135deg, #fff3cd, #ffe8a3);
            color: #b88700;
        }
        .status.selesai {
            background: linear-gradient(135deg, #d1e7dd, #a3d9b3);
            color: #0f5132;
        }
        .status.pending {
            background: linear-gradient(135deg, #fff3cd, #ffe8a3);
            color: #b88700;
        }
        .status.completed {
            background: linear-gradient(135deg, #d1e7dd, #a3d9b3);
            color: #0f5132;
        }
        .empty {
            text-align: center;
            padding: 64px 24px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 2px dashed rgba(255, 105, 180, 0.3);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(255, 105, 180, 0.1);
        }
        .empty i {
            font-size: 64px;
            color: var(--pink-300);
            margin-bottom: 16px;
            opacity: 0.7;
        }
        .empty-title {
            font-weight: 800;
            color: var(--pink-400);
            margin-bottom: 8px;
            font-size: 20px;
        }
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .alert-success {
            background: linear-gradient(135deg, #e6ffed, #c3f4d3);
            color: #0f5132;
            border: 1px solid #90ee90;
        }
    </style>
</head>
<body>
    <header class="nav">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-birthday-cake"></i>
                <span>SweetCake</span>
            </a>
            <div class="nav-right">
                @auth
                    @php $cartCount = collect(session('cart', []))->sum('jumlah'); @endphp
                    <a href="{{ route('cart.index') }}" class="icon-btn" title="Keranjang">
                        <i class="fas fa-shopping-cart"></i>
                        @if($cartCount > 0)
                        <span class="badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown">
                        <button class="icon-btn" title="Akun" type="button">
                            <i class="fas fa-user"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('orders.index') }}">
                                <i class="fas fa-shopping-bag"></i>
                                Pesanan Saya
                            </a>
                            <a href="{{ route('orders.notifications') }}">
                                <i class="fas fa-bell"></i>
                                Notifikasi
                            </a>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-edit"></i>
                                Edit Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk
                    </a>
                    <a class="link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i>
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </header>
    <div class="container">
        <div class="page-head">
            <div>
                <div class="page-title">
                    <i class="fas fa-bell"></i>
                    Notifikasi Saya
                </div>
                <div class="muted">
                    <i class="fas fa-info-circle"></i>
                    Lihat semua notifikasi terkait pesanan Anda.
                </div>
            </div>
            <div>
                <a href="{{ route('orders.index') }}" class="btn btn-outline">
                    <i class="fas fa-shopping-bag"></i>
                    Pesanan Saya
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @forelse($notifications as $notif)
            <div class="card">
                <div class="card-header">
                    <div>
                        <span class="card-title">
                            <i class="fas fa-receipt"></i>
                            Pesanan #{{ $notif->pesanan_id }}
                        </span>
                        @if($notif->pesanan)
                            <span class="status {{ strtolower($notif->pesanan->status) }}">
                                @if(strtolower($notif->pesanan->status) == 'completed' || strtolower($notif->pesanan->status) == 'selesai')
                                    <i class="fas fa-check-circle"></i>
                                @elseif(strtolower($notif->pesanan->status) == 'pending' || strtolower($notif->pesanan->status) == 'diproses')
                                    <i class="fas fa-clock"></i>
                                @else
                                    <i class="fas fa-info-circle"></i>
                                @endif
                                {{ ucfirst($notif->pesanan->status) }}
                            </span>
                        @endif
                    </div>
                    <div class="card-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($notif->tanggal_kirim)->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="card-body">
                    <div style="flex: 1;">
                        <i class="fas fa-quote-left" style="color: var(--pink-300); margin-right: 8px;"></i>
                        {{ $notif->pesan }}
                    </div>
                </div>
                <div style="margin-top:16px;">
                    <a href="{{ route('orders.show', $notif->pesanan_id) }}" class="btn btn-outline">
                        <i class="fas fa-eye"></i>
                        Lihat Detail Pesanan
                    </a>
                </div>
            </div>
        @empty
            <div class="empty">
                <i class="fas fa-bell-slash"></i>
                <div class="empty-title">Belum ada notifikasi</div>
                <div class="muted" style="margin-bottom:20px;">
                    <i class="fas fa-info-circle"></i>
                    Anda akan menerima notifikasi di sini ketika ada update terkait pesanan Anda.
                </div>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i>
                    Jelajahi Produk
                </a>
            </div>
        @endforelse
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dd => {
                const btn = dd.querySelector('button.icon-btn');
                const menu = dd.querySelector('.dropdown-menu');
                if (!btn || !menu) return;
                btn.setAttribute('type', 'button');
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdowns.forEach(d => { if (d !== dd) d.classList.remove('open'); });
                    dd.classList.toggle('open');
                });
                menu.addEventListener('click', function(e){ e.stopPropagation(); });
            });
            document.addEventListener('click', function(){ dropdowns.forEach(dd => dd.classList.remove('open')); });
            document.addEventListener('keydown', function(e){ if(e.key === 'Escape'){ dropdowns.forEach(dd => dd.classList.remove('open')); } });
        });
    </script>
</body>
</html>


