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
        @media (max-width:1000px){ .grid { grid-template-columns: repeat(2, 1fr);} .hero { grid-template-columns:1fr; } }
        @media (max-width:700px){ .grid { grid-template-columns: 1fr;} }
    </style>
</head>
<body>
    <section class="hero">
        <div class="hero-card">
            <div class="brand">
                <div class="logo">🧁</div>
                <div class="brand-name">SweetCake</div>
            </div>
            <h1>Kue Manis untuk Hari Bahagiamu</h1>
            <p class="lead">Jelajahi katalog kue terbaik kami. Dari cupcake lembut hingga cake premium — semua dibuat dengan cinta 💖</p>
            <div class="cta">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-outline">Daftar</a>
            </div>
        </div>
        <div class="hero-card" style="text-align:center; background: linear-gradient(135deg, #fff, #fff7fb);">
            <div style="font-size: 80px;">🍰</div>
            <div style="margin-top: 10px; color:#888;">Manis, Cantik, dan Menggoda</div>
        </div>
    </section>

    <section class="catalog">
        <div class="section-title">Katalog Kue</div>
        <div class="grid">
            @php
                $produk = collect([
                    ['nama_produk' => 'Cupcake Strawberry','harga' => 25000,'deskripsi' => 'Cupcake lembut dengan topping strawberry segar dan krim manis.','foto' => 'img/Cupcake Strawberry.jpeg'],
                    ['nama_produk' => 'Black Forest','harga' => 120000,'deskripsi' => 'Cake cokelat klasik dengan lapisan krim dan ceri.','foto' => 'img/Black Forest.jpeg'],
                    ['nama_produk' => 'Cheesecake','harga' => 95000,'deskripsi' => 'Cheesecake creamy dengan base biskuit renyah.','foto' => 'img/Cheesecake.jpeg'],
                    ['nama_produk' => 'Red Velvet','harga' => 110000,'deskripsi' => 'Red Velvet cake dengan cream cheese frosting.','foto' => 'img/Red Velvet.jpeg'],
                    ['nama_produk' => 'Matcha Mousse','harga' => 105000,'deskripsi' => 'Mousse lembut rasa matcha premium.','foto' => 'img/Matcha Mousse.jpeg'],
                ])->map(function($d){ return (object) $d; });
            @endphp
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
                        <a href="#" class="btn btn-primary">Tambah ke Keranjang</a>
                        <a href="#" class="btn btn-outline">Detail</a>
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
</body>
</html>