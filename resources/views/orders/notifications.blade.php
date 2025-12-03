<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Saya - SweetCake</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f8f9fa; margin:0; }
        .container { max-width: 1000px; margin: 30px auto; background:#fff; border-radius: 12px; padding: 20px; box-shadow: 0 6px 20px rgba(0,0,0,.08); }
        /* Navbar */
        .nav { position: sticky; top:0; background: rgba(255,255,255,0.95); backdrop-filter: blur(8px); border-bottom: 1px solid #ffe0eb; }
        .nav-inner { max-width:1100px; margin:0 auto; padding:10px 24px; display:flex; align-items:center; justify-content:space-between; }
        .nav-brand { display:flex; align-items:center; gap:10px; font-weight:800; color:#ff4d8a; }
        .nav-right { display:flex; align-items:center; gap:12px; }
        .link { color:#ff4d8a; text-decoration:none; font-weight:700; }
        .icon-btn { position:relative; display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:999px; background:#fff; border:2px solid #ff4d8a; color:#ff4d8a; cursor:pointer; text-decoration:none; }
        .badge { position:absolute; top:-6px; right:-6px; background:#ff4d8a; color:#fff; border-radius:999px; padding:2px 6px; font-size:11px; font-weight:800; }
        .dropdown { position:relative; }
        .dropdown-menu { position:absolute; right:0; top:46px; background:#fff; border:1px solid #ffe0eb; border-radius:10px; box-shadow:0 10px 24px rgba(255,105,180,.25); min-width:180px; display:none; z-index:1000; }
        .dropdown-menu a { display:block; padding:10px 12px; color:#333; text-decoration:none; }
        .dropdown-menu a:hover { background:#ffe6ee; color:#ff4d8a; }
        .dropdown.open .dropdown-menu { display:block; }
        .dropdown-menu form { margin:0; }
        .dropdown-menu button { width:100%; padding:10px 12px; border:none; background:#fff; text-align:left; cursor:pointer; }
        .dropdown-menu button:hover { background:#ffe6ee; color:#ff4d8a; }
        .page-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .page-title { font-size:24px; font-weight:800; color:#ff4d8a; margin-bottom:4px; }
        .muted { color:#666; font-size:14px; }
        .btn { border:none; padding:10px 20px; border-radius:8px; font-weight:700; cursor:pointer; text-decoration:none; display:inline-block; }
        .btn-primary { background:#ff4d8a; color:white; }
        .btn-outline { background:#fff; color:#ff4d8a; border:2px solid #ff4d8a; }
        .card { background:#fff; border:1px solid #ffe0eb; border-radius:12px; padding:20px; margin-bottom:16px; box-shadow:0 2px 8px rgba(0,0,0,.05); }
        .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
        .card-title { font-size:18px; font-weight:700; color:#333; }
        .card-date { font-size:12px; color:#999; }
        .card-body { color:#555; line-height:1.6; }
        .status { padding:4px 10px; border-radius:6px; font-size:11px; font-weight:700; text-transform:capitalize; margin-left:8px; }
        .status.baru { background:#e3f2fd; color:#0d47a1; }
        .status.diproses { background:#fff3cd; color:#b88700; }
        .status.selesai { background:#d1e7dd; color:#0f5132; }
        .empty { text-align:center; padding:40px; color:#999; }
    </style>
</head>
<body>
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
                        <button class="icon-btn" title="Akun" type="button" onclick="this.parentElement.classList.toggle('open')">👤</button>
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
    <div class="container">
        <div class="page-head">
            <div>
                <div class="page-title">🔔 Notifikasi Saya</div>
                <div class="muted">Lihat semua notifikasi terkait pesanan Anda.</div>
            </div>
            <div>
                <a href="{{ route('orders.index') }}" class="btn btn-outline">Pesanan Saya</a>
            </div>
        </div>

        @if(session('success'))
            <div style="background:#e6ffed; color:#0f5132; padding:10px; border-radius:8px; margin-bottom:12px;">{{ session('success') }}</div>
        @endif

        @forelse($notifications as $notif)
            <div class="card">
                <div class="card-header">
                    <div>
                        <span class="card-title">Pesanan #{{ $notif->pesanan_id }}</span>
                        @if($notif->pesanan)
                            <span class="status {{ $notif->pesanan->status }}">{{ ucfirst($notif->pesanan->status) }}</span>
                        @endif
                    </div>
                    <div class="card-date">
                        {{ \Carbon\Carbon::parse($notif->tanggal_kirim)->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="card-body">
                    {{ $notif->pesan }}
                </div>
                <div style="margin-top:12px;">
                    <a href="{{ route('orders.show', $notif->pesanan_id) }}" class="btn btn-outline" style="font-size:13px; padding:6px 12px;">
                        Lihat Detail Pesanan
                    </a>
                </div>
            </div>
        @empty
            <div class="empty">
                <div style="font-size:48px; margin-bottom:12px;">🔔</div>
                <div style="font-weight:800; color:#ff4d8a; margin-bottom:6px;">Belum ada notifikasi</div>
                <div class="muted" style="margin-bottom:12px;">Anda akan menerima notifikasi di sini ketika ada update terkait pesanan Anda.</div>
                <a href="{{ route('home') }}" class="btn btn-primary">Jelajahi Produk</a>
            </div>
        @endforelse
    </div>
    <script>
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('open');
                }
            });
        });
    </script>
</body>
</html>


