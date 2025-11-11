<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetCake - Home</title>
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
            background: linear-gradient(135deg, var(--pink-200) 0%, var(--pink-300) 100%);
            color: #333;
        }
        .hero {
            max-width: 1100px; margin: 0 auto; padding: 56px 24px 24px;
            display: grid; grid-template-columns: 1.4fr 1fr; gap: 24px; align-items: center;
        }
        .hero-card {
            background: #fff; border-radius: 22px; padding: 28px; box-shadow: 0 20px 60px rgba(255,105,180,0.35);
        }
        .brand {
            display:flex; align-items:center; gap:14px; margin-bottom: 14px;
        }
        .logo { width: 54px; height:54px; border-radius: 16px; background: linear-gradient(135deg, var(--pink-200), var(--pink-300)); display:flex; align-items:center; justify-content:center; font-size:26px; box-shadow: 0 10px 24px rgba(255,105,180,.35); }
        .brand-name { font-weight: 800; font-size: 20px; background: linear-gradient(135deg, var(--pink-300), var(--pink-500)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        h1 { margin: 8px 0 12px; font-size: 32px; color: var(--pink-400); }
        p.lead { color:#666; line-height:1.6; }
        .cta { margin-top:16px; display:flex; gap:12px; }
        .btn { border:none; padding:12px 18px; border-radius:10px; font-weight:700; cursor:pointer; }
        .btn-primary { background: var(--pink-400); color:#fff; }
        .btn-outline { background:#fff; color: var(--pink-400); border: 2px solid var(--pink-300); }

        .catalog { max-width:1100px; margin: 10px auto 40px; padding: 0 24px; }
        .section-title { color:#fff; font-weight:800; letter-spacing:.5px; text-transform:uppercase; font-size:13px; margin-bottom:10px; }
        .grid { display:grid; grid-template-columns: repeat(4, 1fr); gap:16px; }
        .card { background:#fff; border-radius:16px; box-shadow:0 14px 34px rgba(0,0,0,.08); overflow:hidden; }
        .thumb { width:100%; height:160px; background: linear-gradient(135deg, var(--pink-200), var(--pink-300)); display:flex; align-items:center; justify-content:center; font-size:28px; }
        .thumb img { width:100%; height:100%; object-fit:cover; }
        .card-body { padding:14px; }
        .card-title { margin:0; font-weight:800; color:#333; }
        .price { color: var(--pink-400); font-weight:800; margin-top:6px; }
        .desc { color:#666; font-size:13px; margin-top:6px; }
        .card-actions { margin-top:10px; display:flex; gap:8px; }
        .card-actions .btn { padding:8px 12px; border-radius:8px; font-weight:700; }
        .footer { text-align:center; color:#fff; padding:20px 0 40px; }
        /* Navbar */
        .nav { position: sticky; top:0; background: rgba(255,255,255,0.9); backdrop-filter: blur(8px); border-bottom: 1px solid #ffe0eb; }
        .nav-inner { max-width:1100px; margin:0 auto; padding:10px 24px; display:flex; align-items:center; justify-content:space-between; }
        .nav-brand { display:flex; align-items:center; gap:10px; font-weight:800; color:#ff4d8a; }
        .nav-right { display:flex; align-items:center; gap:12px; }
        .link { color:#ff4d8a; text-decoration:none; font-weight:700; }
        .icon-btn { position:relative; display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:999px; background:#fff; border:2px solid #ff4d8a; color:#ff4d8a; cursor:pointer; }
        .badge { position:absolute; top:-6px; right:-6px; background:#ff4d8a; color:#fff; border-radius:999px; padding:2px 6px; font-size:11px; font-weight:800; }
        .dropdown { position:relative; }
        .dropdown-menu { position:absolute; right:0; top:46px; background:#fff; border:1px solid #ffe0eb; border-radius:10px; box-shadow:0 10px 24px rgba(255,105,180,.25); min-width:180px; display:none; }
        .dropdown-menu a { display:block; padding:10px 12px; color:#333; text-decoration:none; }
        .dropdown-menu a:hover { background:#ffe6ee; color:#ff4d8a; }
        .dropdown.open .dropdown-menu { display:block; }
        .dropdown-menu form { margin:0; }
        .dropdown-menu button { width:100%; padding:10px 12px; border:none; background:#fff; text-align:left; cursor:pointer; }
        .dropdown-menu button:hover { background:#ffe6ee; color:#ff4d8a; }
        @media (max-width:1000px){ .grid { grid-template-columns: repeat(2, 1fr);} .hero { grid-template-columns:1fr; } }
        @media (max-width:700px){ .grid { grid-template-columns: 1fr;} }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="nav">
        <div class="nav-inner">
            <div class="nav-brand">
                <span style="font-size:20px;">🧁</span>
                <span>SweetCake</span>
            </div>
            <div class="nav-right">
                @auth
                    @php $cartCount = collect(session('cart', []))->sum('jumlah'); @endphp
                    <a href="{{ route('cart.index') }}" class="icon-btn" title="Keranjang">
                        🛒
                        @if($cartCount > 0)
                        <span class="badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown">
                        <button class="icon-btn" title="Akun">👤</button>
                        <div class="dropdown-menu">
                            <a href="{{ route('orders.index') }}">Pesanan Saya</a>
                            <a href="{{ route('profile.edit') }}">Edit Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="link" href="{{ route('login') }}">Masuk</a>
                    <a class="link" href="{{ route('register') }}">Daftar</a>
                @endauth
            </div>
        </div>
    </header>
    <section class="hero">
        <div class="hero-card">
            <div class="brand">
                <div class="logo">🧁</div>
                <div class="brand-name">SweetCake</div>
            </div>
            <h1>Kue Manis untuk Hari Bahagiamu</h1>
            <p class="lead">Jelajahi katalog kue terbaik kami. Dari cupcake lembut hingga cake premium — semua dibuat dengan cinta 💖</p>
            @guest
            <div class="cta">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-outline">Daftar</a>
            </div>
            @endguest
        </div>
        <div class="hero-card" style="text-align:center; background: linear-gradient(135deg, #fff, #fff7fb);">
            <div style="font-size: 80px;">🍰</div>
            <div style="margin-top: 10px; color:#888;">Manis, Cantik, dan Menggoda</div>
        </div>
    </section>

    <section class="catalog">
        <div class="section-title">Katalog Kue</div>
        <div class="grid">
            @forelse ($produk as $p)
            <div class="card">
                <div class="thumb">
                    @if($p->foto)
                        <img src="{{ asset($p->foto) }}" alt="{{ $p->nama_produk }}">
                    @else
                        <span>🍰</span>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $p->nama_produk }}</h4>
                    <div class="price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                    <div class="desc">{{ $p->deskripsi ? (strlen($p->deskripsi) > 80 ? substr($p->deskripsi, 0, 80).'…' : $p->deskripsi) : 'Kue lezat dari SweetCake.' }}</div>
                    <div class="card-actions">
                        @auth
                        <form method="POST" action="{{ route('cart.add', $p->produk_id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Masuk untuk beli</a>
                        @endauth
                        <a href="{{ route('produk.show', $p->produk_id) }}" class="btn btn-outline">Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="card" style="grid-column: 1 / -1; text-align:center; padding: 20px;">
                Belum ada data kue.
            </div>
            @endforelse
        </div>
    </section>

    <div class="footer">© {{ date('Y') }} SweetCake — Rasa Bahagia Setiap Hari</div>
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