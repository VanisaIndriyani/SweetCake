<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SweetCake</title>
    <style>
        :root {
            --pink-100: #ffe6f2;
            --pink-200: #ffb6c1;
            --pink-300: #ff69b4;
            --pink-400: #ff4d8a;
            --pink-500: #ff1493;
            --bg: #f8f9fa;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: #333;
        }
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 280px; height: 100vh;
            background: #fff;
            box-shadow: 2px 0 14px rgba(255, 105, 180, 0.12);
            padding: 24px 20px;
        }
        .brand {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 28px;
        }
        .brand-logo {
            width: 48px; height: 48px; border-radius: 12px;
            background: linear-gradient(135deg, var(--pink-200), var(--pink-300));
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 20px rgba(255, 105, 180, 0.35);
            font-size: 24px;
        }
        .brand-name {
            font-weight: 800; font-size: 18px;
            background: linear-gradient(135deg, var(--pink-300), var(--pink-500));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .menu {
            margin-top: 20px;
        }
        .menu a {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 14px; margin: 6px 0;
            color: #333; text-decoration: none; border-radius: 10px;
            transition: all .25s;
        }
        .menu a:hover, .menu a.active {
            background: var(--pink-100);
            color: var(--pink-400);
        }
        .menu .section-title {
            margin-top: 14px; margin-bottom: 8px; color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: .5px;
        }
        /* Main */
        .main {
            margin-left: 280px; padding: 32px;
        }
        header {
            background: #fff; padding: 16px 20px; border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,.06);
            display: flex; justify-content: space-between; align-items: center;
        }
        .welcome {
            color: var(--pink-400); font-weight: 700;
        }
        .logout-btn {
            background: var(--pink-400); color: #fff; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; font-weight: 600;
        }
        .logout-btn:hover { background: var(--pink-500); }
        /* Cards */
        .cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-top: 24px; }
        .card { background: #fff; border-radius: 14px; padding: 18px; box-shadow: 0 8px 24px rgba(0,0,0,.06); }
        .card h4 { margin: 0; color: #888; font-size: 13px; }
        .card .value { margin-top: 6px; font-size: 24px; font-weight: 800; color: var(--pink-400); }
        /* Table */
        .panel { margin-top: 24px; background: #fff; border-radius: 14px; box-shadow: 0 8px 24px rgba(0,0,0,.06); padding: 18px; }
        .panel h3 { margin: 0 0 10px; color: var(--pink-400); }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 10px; border-bottom: 1px solid #eee; }
        th { font-size: 12px; text-transform: uppercase; letter-spacing: .5px; color: #999; }
        tr:hover { background: #fff7fb; }
        .status { padding: 6px 10px; border-radius: 8px; font-size: 12px; font-weight: 700; }
        .status.baru { background: #ffe6ee; color: var(--pink-400); }
        .status.diproses { background: #fff3cd; color: #b88700; }
        .status.selesai { background: #d1e7dd; color: #0f5132; }
        @media (max-width: 1000px) {
            .cards { grid-template-columns: repeat(2, 1fr); }
            .main { padding: 22px; }
        }
        @media (max-width: 700px) {
            .sidebar { width: 220px; }
            .main { margin-left: 220px; }
            .cards { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo">🧁</div>
            <div class="brand-name">SweetCake Admin</div>
        </div>
        <nav class="menu">
            <div class="section-title">Menu</div>
            <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
            <a href="#">Mengelola Produk</a>
            <a href="#">Melihat Pesanan Pelanggan</a>
            <a href="#">Memverifikasi Pembayaran</a>
            <a href="#">Laporan Penjualan</a>
            <div class="section-title">Lainnya</div>
            <a href="#">Notifikasi</a>
            <a href="#">Pengaturan</a>
        </nav>
    </aside>

    <main class="main">
        <header>
            <div class="welcome">Halo, {{ Auth::user()->nama }} 👋</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </header>

        <section class="cards">
            <div class="card">
                <h4>Pesanan Baru</h4>
                <div class="value">12</div>
            </div>
            <div class="card">
                <h4>Produk Aktif</h4>
                <div class="value">58</div>
            </div>
            <div class="card">
                <h4>Pembayaran Tertunda</h4>
                <div class="value">4</div>
            </div>
            <div class="card">
                <h4>Penjualan Bulan Ini</h4>
                <div class="value">Rp 12.450.000</div>
            </div>
        </section>

        <section class="panel">
            <h3>Daftar Kue</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Nama Kue</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $p)
                    <tr>
                        <td>{{ $p->produk_id }}</td>
                        <td>
                            @if($p->foto)
                                <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama_produk }}" style="width:48px;height:48px;border-radius:10px;box-shadow:0 4px 10px rgba(255,105,180,0.25);object-fit:cover;">
                            @else
                                <div style="width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--pink-200),var(--pink-300));display:flex;align-items:center;justify-content:center;box-shadow:0 4px 10px rgba(255,105,180,0.25);">🍰</div>
                            @endif
                        </td>
                        <td>{{ $p->nama_produk }}</td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td>{{ $p->stok }}</td>
                        <td>{{ $p->deskripsi ? (strlen($p->deskripsi) > 60 ? substr($p->deskripsi, 0, 60).'…' : $p->deskripsi) : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#888;">Belum ada data kue.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>