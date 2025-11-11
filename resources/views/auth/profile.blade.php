<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - SweetCake</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f8f9fa; margin:0; }
        .container { max-width: 800px; margin: 30px auto; background:#fff; border-radius: 12px; padding: 20px; box-shadow: 0 6px 20px rgba(0,0,0,.08); }
        .form-group { margin-bottom: 12px; }
        label { display:block; margin-bottom: 6px; color:#555; }
        input { width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; }
        .btn { border:none; padding:10px 14px; border-radius:8px; font-weight:700; cursor:pointer; }
        .btn-primary { background:#ff4d8a; color:#fff; }
        .muted { color:#666; }
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
    <div class="container">
        <h2>Edit Profil</h2>
        @if(session('success'))
            <div style="background:#e6ffed; color:#0f5132; padding:10px; border-radius:8px; margin-top:10px;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}">
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
            </div>
            <div class="form-group">
                <label for="password">Password (opsional)</label>
                <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <div class="muted" style="margin-top:10px;">
            <a href="{{ route('home') }}" style="color:#ff4d8a; text-decoration:none;">Kembali ke Home</a>
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