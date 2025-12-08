<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetCake - Home</title>
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
        .hero {
            max-width: 1100px; margin: 0 auto; padding: 56px 24px 24px;
            display: grid; grid-template-columns: 1.4fr 1fr; gap: 24px; align-items: center;
            position: relative; z-index: 1;
        }
        .hero-card {
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px);
            border-radius: 24px; padding: 32px; 
            box-shadow: 0 20px 60px rgba(255,105,180,0.25);
            border: 1px solid rgba(255, 105, 180, 0.2);
            transition: all 0.3s ease;
        }
        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 70px rgba(255,105,180,0.35);
        }
        .brand {
            display:flex; align-items:center; gap:14px; margin-bottom: 18px;
        }
        .logo { 
            width: 60px; height:60px; border-radius: 18px; 
            background: linear-gradient(135deg, var(--pink-200), var(--pink-300), var(--pink-400)); 
            display:flex; align-items:center; justify-content:center; 
            font-size:28px; 
            box-shadow: 0 10px 24px rgba(255,105,180,.4);
            transition: all 0.3s ease;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(5deg); }
        }
        .logo:hover {
            transform: scale(1.1) rotate(10deg);
            animation: none;
        }
        .brand-name { 
            font-weight: 800; font-size: 24px; 
            background: linear-gradient(135deg, var(--pink-300), var(--pink-500)); 
            -webkit-background-clip:text; 
            -webkit-text-fill-color:transparent; 
        }
        h1 { margin: 12px 0 16px; font-size: 36px; color: var(--pink-400); font-weight: 800; line-height: 1.2; }
        p.lead { color:#666; line-height:1.7; font-size: 15px; }
        .cta { margin-top:20px; display:flex; gap:12px; flex-wrap: wrap; }
        .btn { 
            border:none; padding:14px 24px; border-radius:12px; 
            font-weight:700; cursor:pointer; font-size:14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex; align-items: center; gap: 8px;
            text-decoration: none;
        }
        .btn-primary { 
            background: linear-gradient(135deg, var(--pink-400), var(--pink-500)); 
            color:#fff; 
            box-shadow: 0 4px 16px rgba(255,77,138,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,77,138,0.4);
        }
        .btn-outline { 
            background:#fff; color: var(--pink-400); 
            border: 2px solid var(--pink-300); 
            box-shadow: 0 2px 8px rgba(255,105,180,0.2);
        }
        .btn-outline:hover {
            background: var(--pink-100);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255,105,180,0.3);
        }

        .catalog { max-width:1100px; margin: 30px auto 50px; padding: 0 24px; position: relative; z-index: 1; }
        .section-title { 
            color:#ff4d8a; font-weight:800; letter-spacing:.5px; 
            text-transform:uppercase; font-size:14px; margin-bottom:20px;
            display: flex; align-items: center; gap: 10px;
        }
        .section-title i {
            font-size: 18px;
        }
        .grid { display:grid; grid-template-columns: repeat(4, 1fr); gap:20px; }
        .card { 
            background:rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px);
            border-radius:18px; box-shadow:0 14px 34px rgba(0,0,0,.1); 
            overflow:hidden; border: 1px solid rgba(255, 105, 180, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(255,105,180,0.25);
            border-color: rgba(255, 105, 180, 0.4);
        }
        .thumb { 
            width:100%; height:180px; 
            background: linear-gradient(135deg, var(--pink-200), var(--pink-300)); 
            display:flex; align-items:center; justify-content:center; 
            font-size:48px; 
            overflow: hidden;
            position: relative;
        }
        .thumb img { 
            width:100%; height:100%; object-fit:cover; 
            transition: transform 0.3s ease;
        }
        .card:hover .thumb img {
            transform: scale(1.1);
        }
        .card-body { padding:18px; }
        .card-title { margin:0; font-weight:800; color:#333; font-size:16px; }
        .price { color: var(--pink-400); font-weight:800; margin-top:8px; font-size:18px; display: flex; align-items: center; gap: 6px; }
        .price i {
            font-size: 14px;
        }
        .desc { color:#666; font-size:13px; margin-top:8px; line-height:1.6; }
        .card-actions { margin-top:14px; display:flex; gap:8px; flex-wrap: wrap; }
        .card-actions .btn { padding:10px 16px; border-radius:10px; font-weight:700; font-size:13px; }
        .footer { 
            text-align:center; color:#ff4d8a; padding:30px 0 50px; 
            font-weight: 600; position: relative; z-index: 1;
        }
        /* Navbar */
        .nav { 
            position: sticky; top:0; 
            background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); 
            border-bottom: 1px solid rgba(255, 105, 180, 0.2); 
            box-shadow: 0 4px 20px rgba(255,105,180,0.1);
            z-index: 1000;
        }
        .nav-inner { max-width:1100px; margin:0 auto; padding:14px 24px; display:flex; align-items:center; justify-content:space-between; }
        .nav-brand { display:flex; align-items:center; gap:12px; font-weight:800; color:#ff4d8a; font-size:20px; }
        .nav-brand i {
            font-size: 24px;
            color: #ff69b4;
        }
        .nav-right { display:flex; align-items:center; gap:12px; }
        .link { 
            color:#ff4d8a; text-decoration:none; font-weight:700; 
            padding: 8px 16px; border-radius: 10px;
            transition: all 0.3s ease;
        }
        .link:hover {
            background: rgba(255, 105, 180, 0.1);
        }
        .icon-btn { 
            position:relative; display:inline-flex; align-items:center; justify-content:center; 
            width:42px; height:42px; border-radius:50%; 
            background:#fff; border:2px solid #ff4d8a; color:#ff4d8a; 
            cursor:pointer; transition: all 0.3s ease;
            font-size: 18px;
        }
        .icon-btn:hover {
            background: #ff4d8a;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(255,77,138,0.3);
        }
        .badge { 
            position:absolute; top:-8px; right:-8px; 
            background:linear-gradient(135deg, #ff4d8a, #ff1c78); 
            color:#fff; border-radius:50%; 
            padding:4px 8px; font-size:11px; font-weight:800;
            min-width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(255,77,138,0.4);
        }
        .dropdown { position:relative; }
        .dropdown-menu { 
            position:absolute; right:0; top:50px; 
            background:rgba(255,255,255,0.98); backdrop-filter: blur(20px);
            border:1px solid rgba(255, 105, 180, 0.2); border-radius:12px; 
            box-shadow:0 10px 30px rgba(255,105,180,.25); 
            min-width:200px; display:none;
            overflow: hidden;
        }
        .dropdown-menu a { 
            display:flex; align-items:center; gap:10px;
            padding:12px 16px; color:#333; text-decoration:none; 
            transition: all 0.2s ease;
        }
        .dropdown-menu a i {
            width: 18px;
            color: #ff69b4;
        }
        .dropdown-menu a:hover { background:rgba(255, 182, 193, 0.2); color:#ff4d8a; }
        .dropdown.open .dropdown-menu { display:block; animation: fadeInDown 0.3s ease; }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-menu form { margin:0; }
        .dropdown-menu button { 
            width:100%; padding:12px 16px; border:none; 
            background:#fff; text-align:left; cursor:pointer; 
            display: flex; align-items: center; gap: 10px;
            transition: all 0.2s ease;
        }
        .dropdown-menu button i {
            width: 18px;
            color: #e74c3c;
        }
        .dropdown-menu button:hover { background:rgba(255, 182, 193, 0.2); color:#e74c3c; }
        @media (max-width:1000px){ .grid { grid-template-columns: repeat(2, 1fr);} .hero { grid-template-columns:1fr; } }
        @media (max-width:700px){ .grid { grid-template-columns: 1fr;} }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="nav">
        <div class="nav-inner">
            <div class="nav-brand">
                <i class="fas fa-birthday-cake"></i>
                <span>SweetCake</span>
            </div>
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
    <section class="hero">
        <div class="hero-card">
            <div class="brand">
                <div class="logo">
                    <i class="fas fa-birthday-cake" style="color: white;"></i>
                </div>
                <div class="brand-name">SweetCake</div>
            </div>
            <h1>Kue Manis untuk Hari Bahagiamu</h1>
            <p class="lead">
                <i class="fas fa-heart" style="color: #ff69b4; margin-right: 6px;"></i>
                Jelajahi katalog kue terbaik kami. Dari cupcake lembut hingga cake premium — semua dibuat dengan cinta
            </p>
            @guest
            <div class="cta">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline">
                    <i class="fas fa-user-plus"></i>
                    Daftar
                </a>
            </div>
            @endguest
        </div>
        <div class="hero-card" style="text-align:center; background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(255,247,251,0.95)); backdrop-filter: blur(20px);">
            <div style="font-size: 80px; color: #ff69b4;">
                <i class="fas fa-birthday-cake"></i>
            </div>
            <div style="margin-top: 16px; color:#666; font-weight: 600; font-size: 16px;">
                <i class="fas fa-star" style="color: #ffd700; margin-right: 4px;"></i>
                Manis, Cantik, dan Menggoda
                <i class="fas fa-star" style="color: #ffd700; margin-left: 4px;"></i>
            </div>
        </div>
    </section>

    <section class="catalog">
        <div class="section-title">
            <i class="fas fa-box-open"></i>
            Katalog Kue
        </div>
        <div class="grid">
            @forelse ($produk as $p)
            <div class="card">
                <div class="thumb">
                    @if($p->foto)
                        @php
                            if (strpos($p->foto, 'img/') === 0) {
                                $imagePath = asset('storage/'.$p->foto);
                            } else {
                                $imagePath = file_exists(public_path('storage/'.$p->foto)) 
                                    ? asset('storage/'.$p->foto) 
                                    : asset($p->foto);
                            }
                        @endphp
                        <img src="{{ $imagePath }}" alt="{{ $p->nama_produk }}">
                    @else
                        <i class="fas fa-birthday-cake" style="color: white; font-size: 48px;"></i>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $p->nama_produk }}</h4>
                    <div class="price">
                        <i class="fas fa-money-bill-wave"></i>
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </div>
                    <div class="desc">{{ $p->deskripsi ? (strlen($p->deskripsi) > 80 ? substr($p->deskripsi, 0, 80).'…' : $p->deskripsi) : 'Kue lezat dari SweetCake.' }}</div>
                    <div class="card-actions">
                        @auth
                        <form method="POST" action="{{ route('cart.add', $p->produk_id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-cart-plus"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i>
                            Masuk untuk beli
                        </a>
                        @endauth
                        <a href="{{ route('produk.show', $p->produk_id) }}" class="btn btn-outline">
                            <i class="fas fa-info-circle"></i>
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="card" style="grid-column: 1 / -1; text-align:center; padding: 40px;">
                <i class="fas fa-inbox" style="font-size: 48px; color: #ddd; margin-bottom: 16px; display: block;"></i>
                <div style="font-size: 16px; font-weight: 600; color: #999;">Belum ada data kue.</div>
            </div>
            @endforelse
        </div>
    </section>

    <div class="footer">
        <i class="fas fa-heart" style="color: #ff69b4; margin-right: 6px;"></i>
        © {{ date('Y') }} SweetCake — Rasa Bahagia Setiap Hari
        <i class="fas fa-heart" style="color: #ff69b4; margin-left: 6px;"></i>
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