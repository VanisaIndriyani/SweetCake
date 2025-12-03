<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - SweetCake</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f8f9fa; margin:0; }
        .container { max-width: 1000px; margin: 30px auto; background:#fff; border-radius: 12px; padding: 20px; box-shadow: 0 6px 20px rgba(0,0,0,.08); }
        table { width:100%; border-collapse: collapse; margin-top: 16px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align:left; }
        th { background:#ffe6ee; }
        .btn { border:none; padding:8px 12px; border-radius:8px; font-weight:700; cursor:pointer; }
        .btn-outline { background:#fff; color:#ff4d8a; border:2px solid #ff4d8a; text-decoration:none; }
        /* Navbar (same as Home/Cart) */
        .nav { position: sticky; top:0; background: rgba(255,255,255,0.95); backdrop-filter: blur(8px); border-bottom: 1px solid #ffe0eb; }
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
        /* Redesigned orders list */
        :root { --pink:#ff4d8a; --light:#ffe6ee; --border:#ffe0eb; --text:#333; }
        .wrap { max-width:1100px; margin: 28px auto; padding: 0 24px; }
        .page-head { display:flex; align-items:center; justify-content:space-between; margin: 8px 0 18px; }
        .page-title { font-size:22px; font-weight:800; color:var(--pink); }
        .muted { color:#777; }
        .card { background:#fff; border:1px solid var(--border); border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,.06); overflow:hidden; margin-bottom:12px; }
        .card-head { padding:14px 16px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
        .card-title { font-weight:800; color:var(--pink); }
        .chips { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
        .chip { display:inline-block; padding:6px 10px; border-radius:999px; background:var(--light); color:var(--pink); font-weight:700; font-size:12px; }
        .chip.success { background:#e6ffed; color:#0f5132; }
        .chip.pending { background:#fff7db; color:#73510d; }
        .chip.failed { background:#ffe6e6; color:#842029; }
        .card-body { padding:14px 16px; }
        .row { display:flex; align-items:center; justify-content:space-between; gap:10px; }
        .label { color:#777; }
        .value { font-weight:800; }
        .actions { display:flex; gap:10px; margin-top:12px; }
        .btn { border:none; padding:10px 14px; border-radius:10px; font-weight:700; cursor:pointer; }
        .btn-primary { background:var(--pink); color:#fff; }
        .btn-outline { background:#fff; color:var(--pink); border:2px solid var(--pink); text-decoration:none; }
        .empty { background:#fff; border:1px dashed var(--border); border-radius:14px; padding:22px; text-align:center; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="nav">
        <div class="nav-inner">
            <div class="nav-brand">
                <span style="font-size:20px;">🧁</span>
                <a href="{{ route('home') }}" class="link" style="font-weight:800;">SweetCake</a>
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
                        <button class="icon-btn" title="Akun" type="button">👤</button>
                        <div class="dropdown-menu">
                            <a href="{{ route('orders.index') }}">Pesanan Saya</a>
                            <a href="{{ route('orders.notifications') }}">🔔 Notifikasi</a>
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
    <div class="wrap">
        <div class="page-head">
            <div>
                <div class="page-title">Pesanan Saya</div>
                <div class="muted">Lihat status pesanan dan lanjutkan aksi yang diperlukan.</div>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-outline">Belanja Lagi</a>
            </div>
        </div>

        @if(session('success'))
            <div style="background:#e6ffed; color:#0f5132; padding:10px; border-radius:8px; margin-bottom:12px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="background:#ffe6e6; color:#842029; padding:10px; border-radius:8px; margin-bottom:12px;">{{ session('error') }}</div>
        @endif

        @forelse($pesanan as $p)
            @php
                $status = strtolower($p->status ?? '');
                $statusClass = $status === 'completed' ? 'success' : ($status === 'pending' ? 'pending' : '');
                $payStatus = strtolower(optional($p->pembayaran)->status ?? '');
                $payClass = $payStatus === 'success' ? 'success' : ($payStatus === 'pending' ? 'pending' : ($payStatus === 'failed' ? 'failed' : ''));
                $metode = optional($p->pembayaran)->metode_pembayaran ?? '-';
                $tanggal = $p->tanggal_pesanan;
            @endphp

            <div class="card">
                <div class="card-head">
                    <div class="card-title">Pesanan #{{ $p->pesanan_id }}</div>
                    <div class="chips">
                        <span class="chip {{ $statusClass }}">Status: {{ ucfirst($p->status ?? '-') }}</span>
                        <span class="chip {{ $payClass }}">Pembayaran: {{ $p->pembayaran ? ucfirst($p->pembayaran->status) : 'Belum' }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="label">Tanggal</div>
                        <div class="value">{{ $tanggal }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Metode Bayar</div>
                        <div class="value">{{ strtoupper($metode) }}</div>
                    </div>
                    
                    @if($p->notifikasi && $p->notifikasi->count() > 0)
                        <div style="margin-top:12px; padding:12px; background:#fff7fb; border-left:3px solid #ff4d8a; border-radius:6px;">
                            <div style="font-weight:700; color:#c2185b; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                                🔔 Notifikasi Terbaru
                            </div>
                            @foreach($p->notifikasi->sortByDesc('tanggal_kirim')->take(2) as $notif)
                                <div style="margin-bottom:8px; padding:8px; background:white; border-radius:6px; font-size:13px;">
                                    <div style="color:#666; margin-bottom:4px;">
                                        {{ \Carbon\Carbon::parse($notif->tanggal_kirim)->format('d/m/Y H:i') }}
                                    </div>
                                    <div style="color:#333;">{{ $notif->pesan }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    <div class="actions">
                        <a href="{{ route('orders.show', $p->pesanan_id) }}" class="btn btn-outline">Lihat Detail</a>
                        @if(!$p->pembayaran || $p->pembayaran->status !== 'success')
                            <a href="{{ route('payment.create', $p->pesanan_id) }}" class="btn btn-primary">Konfirmasi Bayar di Toko</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty">
                <div style="font-weight:800; color:var(--pink); margin-bottom:6px;">Belum ada pesanan</div>
                <div class="muted" style="margin-bottom:12px;">Mulai belanja kue favoritmu di SweetCake.</div>
                <a href="{{ route('home') }}" class="btn btn-primary">Jelajahi Produk</a>
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