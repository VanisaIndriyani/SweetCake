<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan #{{ $pesanan->pesanan_id }} - SweetCake</title>
    <style>
        :root { --pink:#ff4d8a; --light:#fff0f6; --border:#ffe0eb; --text:#333; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f8f9fa; margin:0; color:var(--text); }
        /* Navbar */
        .nav { position: sticky; top:0; background: rgba(255,255,255,0.96); backdrop-filter: blur(8px); border-bottom: 1px solid var(--border); }
        .nav-inner { max-width:1100px; margin:0 auto; padding:10px 24px; display:flex; align-items:center; justify-content:space-between; }
        .nav-brand { display:flex; align-items:center; gap:10px; font-weight:800; color:var(--pink); }
        .nav-right { display:flex; align-items:center; gap:12px; }
        .link { color:var(--pink); text-decoration:none; font-weight:700; }
        .icon-btn { position:relative; display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:999px; background:#fff; border:2px solid var(--pink); color:var(--pink); cursor:pointer; }
        .badge { position:absolute; top:-6px; right:-6px; background:var(--pink); color:#fff; border-radius:999px; padding:2px 6px; font-size:11px; font-weight:800; }
        .dropdown { position:relative; }
        .dropdown-menu { position:absolute; right:0; top:46px; background:#fff; border:1px solid var(--border); border-radius:10px; box-shadow:0 10px 24px rgba(255,105,180,.25); min-width:180px; display:none; }
        .dropdown-menu a { display:block; padding:10px 12px; color:#333; text-decoration:none; }
        .dropdown-menu a:hover { background:#ffe6ee; color:var(--pink); }
        .dropdown.open .dropdown-menu { display:block; }
        .dropdown-menu form { margin:0; }
        .dropdown-menu button { width:100%; padding:10px 12px; border:none; background:#fff; text-align:left; cursor:pointer; }
        .dropdown-menu button:hover { background:#ffe6ee; color:var(--pink); }

        /* Layout */
        .wrap { max-width:1100px; margin: 28px auto; padding: 0 24px; }
        .grid { display:grid; grid-template-columns: 1.1fr 0.9fr; gap:24px; align-items:start; }
        .card { background:#fff; border:1px solid var(--border); border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,.06); }
        .card .card-head { padding:16px 18px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; }
        .card .card-body { padding:18px; }
        .title { font-weight:800; color:var(--pink); }

        /* Order summary table */
        table { width:100%; border-collapse:collapse; }
        th, td { padding:10px; border-bottom:1px solid #eee; text-align:left; }
        th { background:var(--light); color:var(--pink); }
        .total { text-align:right; font-weight:800; margin-top:10px; }

        /* QRIS card */
        .qris-banner { display:flex; align-items:center; gap:10px; font-weight:800; color:#222; }
        .qris-tag { background:#000; color:#fff; padding:4px 8px; border-radius:6px; font-weight:900; letter-spacing:1px; }
        .qr-box { display:flex; flex-direction:column; align-items:center; gap:10px; }
        .qr { width:220px; height:220px; background:repeating-linear-gradient(45deg,#000 0 10px,#fff 10px 20px); border:8px solid #000; border-radius:8px; }
        .hint { background:var(--light); border:1px dashed var(--border); padding:10px; border-radius:10px; color:#555; }
        .btn { border:none; padding:12px 14px; border-radius:10px; font-weight:800; cursor:pointer; }
        .btn-primary { background:var(--pink); color:#fff; }
        .upload { display:flex; flex-direction:column; gap:8px; }
        .upload input[type="file"] { width:100%; padding:10px; border:1px solid #ddd; border-radius:10px; }
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
        @php
            $total = 0;
            foreach($pesanan->details as $d){ $harga = $d->produk ? $d->produk->harga : 0; $total += $harga * $d->jumlah; }
        @endphp

        <div class="grid">
            <!-- Order summary -->
            <div class="card">
                <div class="card-head">
                    <div class="title">Pesanan #{{ $pesanan->pesanan_id }}</div>
                    <div style="color:#777;">Total: <strong>Rp {{ number_format($total,0,',','.') }}</strong></div>
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
                            @foreach($pesanan->details as $d)
                                @php $harga = $d->produk ? $d->produk->harga : 0; $sub = $harga * $d->jumlah; @endphp
                                <tr>
                                    <td>{{ $d->produk ? $d->produk->nama_produk : 'Produk' }}</td>
                                    <td>Rp {{ number_format($harga,0,',','.') }}</td>
                                    <td>{{ $d->jumlah }}</td>
                                    <td>Rp {{ number_format($sub,0,',','.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pembayaran Online -->
            <div class="card">
                <div class="card-head">
                    <div class="title">Pembayaran Online</div>
                    <div style="color:#777;">Nominal: <strong>Rp {{ number_format($total,0,',','.') }}</strong></div>
                </div>
                <div class="card-body">
                    <div class="hint">Pilih metode online dan unggah bukti pembayaran (transfer/kartu). Admin akan memverifikasi.</div>

                    @if(session('error'))
                        <div style="background:#ffe6e6; color:#842029; padding:10px; border-radius:8px; margin-top:12px;">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('payment.store', $pesanan->pesanan_id) }}" enctype="multipart/form-data" style="margin-top:14px; display:grid; gap:10px;">
                        @csrf
                        <label for="metode_pembayaran" style="font-weight:700; color:#555;">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" style="padding:10px; border:1px solid #ddd; border-radius:10px;">
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="kartu_kredit">Kartu Kredit</option>
                        </select>
                        <div class="upload">
                            <label for="bukti" style="font-weight:700; color:#555;">Unggah Bukti Pembayaran</label>
                            <input type="file" id="bukti" name="bukti" accept=".jpg,.jpeg,.png,.webp,.pdf">
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Bukti & Simpan Metode</button>
                    </form>
                </div>
            </div>

            <!-- Bayar di Toko (COD) -->
            <div class="card">
                <div class="card-head">
                    <div class="title">Pembayaran di Toko</div>
                    <div style="color:#777;">Nominal: <strong>Rp {{ number_format($total,0,',','.') }}</strong></div>
                </div>
                <div class="card-body">
                    <div class="hint">Silakan lakukan pembayaran langsung di toko saat pengambilan pesanan. Tidak perlu upload bukti sekarang.</div>
                    <form method="POST" action="{{ route('payment.store', $pesanan->pesanan_id) }}" style="margin-top:14px;">
                        @csrf
                        <input type="hidden" name="metode_pembayaran" value="cod">
                        <button type="submit" class="btn btn-primary">Konfirmasi Bayar di Toko</button>
                    </form>
                </div>
            </div>
        </div>
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