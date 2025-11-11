<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $pesanan->pesanan_id }} - SweetCake</title>
    <style>
        /* Navbar styles */
        :root { --pink:#ff4d8a; --light:#ffe6ee; --dark:#333; }
        .navbar { position: sticky; top:0; z-index:1000; display:flex; justify-content:space-between; align-items:center; padding:12px 20px; background:#fff; box-shadow:0 2px 10px rgba(0,0,0,.06); }
        .navbar .brand { font-weight:800; font-size:20px; color:var(--pink); text-decoration:none; }
        .nav-actions { display:flex; align-items:center; gap:16px; }
        .icon-btn { position:relative; width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; background:var(--light); color:var(--pink); cursor:pointer; border:none; }
        .badge-count { position:absolute; top:-4px; right:-4px; background:var(--pink); color:#fff; border-radius:999px; padding:2px 6px; font-size:12px; font-weight:700; }
        .dropdown { position:relative; }
        .dropdown-menu { position:absolute; top:44px; right:0; background:#fff; border:1px solid #eee; border-radius:10px; box-shadow:0 6px 20px rgba(0,0,0,.08); padding:8px; display:none; min-width:180px; }
        .dropdown-menu.show { display:block; }
        .dropdown-item { display:block; padding:10px; border-radius:8px; color:var(--dark); text-decoration:none; }
        .dropdown-item:hover { background:var(--light); color:var(--pink); }

        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f8f9fa; margin:0; }
        .container { max-width: 1100px; margin: 24px auto; padding: 0 20px; }
        .page-head { background:#fff; border:1px solid #eee; border-radius: 12px; padding: 16px 18px; box-shadow: 0 6px 20px rgba(0,0,0,.06); display:flex; justify-content:space-between; align-items:center; }
        .page-title { font-weight:800; color:var(--pink); }
        .chips { display:flex; gap:10px; align-items:center; }
        .chip { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; background:#fff; border:1px solid #eee; color:#555; font-weight:600; }
        .chip.status { background:var(--light); color:var(--pink); border-color:var(--light); }
        .grid { display:grid; grid-template-columns: 1.15fr 0.85fr; gap:22px; margin-top: 18px; }
        .card { background:#fff; border:1px solid #eee; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,.06); overflow:hidden; }
        .card-head { padding:14px 16px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; }
        .card-title { font-weight:800; color:var(--pink); }
        .card-body { padding:16px; }
        table { width:100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #f0f0f0; text-align:left; }
        th { background:var(--light); color:var(--pink); }
        .muted { color:#666; }
        .badge { display:inline-block; padding:6px 10px; border-radius: 999px; background:#ffe6ee; color:#ff4d8a; font-weight:700; }
        .total { text-align:right; font-weight:800; margin-top:10px; }
        .actions { display:flex; gap:10px; }
        .btn { border:none; padding:10px 14px; border-radius:10px; font-weight:700; cursor:pointer; }
        .btn-primary { background:var(--pink); color:#fff; }
        .btn-light { background:#fff; border:1px solid #eee; color:#555; }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="{{ route('home') }}" class="brand">SweetCake</a>
        <div class="nav-actions">
            <a href="{{ route('cart.index') }}" class="icon-btn" aria-label="Keranjang">
                🛒
                <span class="badge-count">{{ session('cart_count', 0) }}</span>
            </a>
            <div class="dropdown">
                <button class="icon-btn" id="profileToggle" aria-expanded="false" aria-controls="profileMenu">👤</button>
                <div class="dropdown-menu" id="profileMenu" role="menu" aria-labelledby="profileToggle">
                    <a class="dropdown-item" href="{{ route('orders.index') }}">Pesanan Saya</a>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" style="width:100%; text-align:left; background:none; border:none; padding:10px; cursor:pointer;">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="page-head">
            <div class="page-title">Detail Pesanan #{{ $pesanan->pesanan_id }}</div>
            <div class="chips">
                <span class="chip">Tanggal: {{ $pesanan->tanggal_pesanan }}</span>
                <span class="chip status">Status: {{ ucfirst($pesanan->status) }}</span>
            </div>
        </div>

        @php $grandTotal = 0; @endphp
        @foreach($pesanan->details as $detail)
            @php $harga = $detail->produk ? $detail->produk->harga : 0; $subtotal = $harga * $detail->jumlah; $grandTotal += $subtotal; @endphp
        @endforeach

        <div class="grid">
            <div class="card">
                <div class="card-head">
                    <div class="card-title">Item Pesanan</div>
                    <div class="muted">Total item: {{ $pesanan->details->count() }}</div>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->details as $detail)
                                @php $harga = $detail->produk ? $detail->produk->harga : 0; $subtotal = $harga * $detail->jumlah; @endphp
                                <tr>
                                    <td>{{ $detail->produk ? $detail->produk->nama_produk : 'Produk' }}</td>
                                    <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-title">Ringkasan</div>
                    <div class="muted">Total: <strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></div>
                </div>
                <div class="card-body">
                    @if($pesanan->pembayaran)
                        <div class="muted">Metode: {{ strtoupper($pesanan->pembayaran->metode_pembayaran) }}</div>
                        <div class="muted" style="margin-top:6px;">Status Pembayaran: <span class="badge">{{ ucfirst($pesanan->pembayaran->status) }}</span></div>
                    @else
                        <div class="muted">Belum ada konfirmasi pembayaran.</div>
                    @endif
                    <div class="actions" style="margin-top:14px;">
                        <a href="{{ route('orders.index') }}" class="btn btn-light">Kembali ke Pesanan</a>
                        @if(!$pesanan->pembayaran)
                            <a href="{{ route('payment.create', $pesanan->pesanan_id) }}" class="btn btn-primary">Konfirmasi Bayar di Toko</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dropdown click-toggle behavior
        (function(){
            const toggle = document.getElementById('profileToggle');
            const menu = document.getElementById('profileMenu');
            if (!toggle || !menu) return;
            function closeMenu(){ menu.classList.remove('show'); toggle.setAttribute('aria-expanded','false'); }
            toggle.addEventListener('click', function(e){ e.stopPropagation(); const isOpen = menu.classList.toggle('show'); toggle.setAttribute('aria-expanded', String(isOpen)); });
            document.addEventListener('click', function(e){ if (!menu.contains(e.target) && e.target !== toggle) { closeMenu(); } });
            document.addEventListener('keydown', function(e){ if (e.key === 'Escape') closeMenu(); });
        })();
    </script>
</body>
</html>