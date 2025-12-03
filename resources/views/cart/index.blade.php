<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - SweetCake</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff5f9;
            margin: 0;
        }

        /* Container */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 12px 30px rgba(255, 126, 173, 0.18);
            animation: fadeIn .4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th {
            background: #ffebf2;
            padding: 14px;
            border-bottom: 2px solid #ffd1e2;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #ff4d8a;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #ffe4ef;
        }

        /* Buttons */
        .btn {
            border: none;
            padding: 8px 14px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: .2s;
        }

        .btn-primary {
            background: #ff4d8a;
            color: #fff;
            box-shadow: 0 4px 12px rgba(255, 77, 138, .3);
        }

        .btn-primary:hover {
            background: #ff2f78;
        }

        .btn-outline {
            background: #fff;
            border: 2px solid #ff4d8a;
            color: #ff4d8a;
        }

        .btn-outline:hover {
            background: #ff4d8a;
            color: #fff;
        }

        /* Qty */
        .qty-input {
            width: 60px;
            padding: 6px;
            border: 1px solid #ffa4c5;
            border-radius: 8px;
        }

        /* Total */
        .total {
            text-align: right;
            margin-top: 18px;
            font-weight: 800;
            font-size: 18px;
            color: #ff2f78;
        }

        /* Navbar */
        .nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #ffd6e8;
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
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ff4d8a;
            font-size: 20px;
        }

        .link {
            color: #ff4d8a;
            text-decoration: none;
            font-weight: 600;
        }

        .icon-btn {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            font-size: 18px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid #ff4d8a;
            background: #fff;
            color: #ff4d8a;
            cursor: pointer;
            transition: .2s;
        }

        .icon-btn:hover {
            background: #ff4d8a;
            color: #fff;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4d8a;
            color: #fff;
            padding: 3px 6px;
            font-size: 11px;
            border-radius: 50%;
            font-weight: 800;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 48px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #ffd6e8;
            box-shadow: 0 10px 28px rgba(255, 105, 180, .28);
            display: none;
            min-width: 180px;
            overflow: hidden;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            padding: 12px;
            text-decoration: none;
            color: #333;
            background: #fff;
            font-size: 14px;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #ffe6f1;
            color: #ff4d8a;
        }

        .dropdown.open .dropdown-menu {
            display: block;
        }

    </style>
</head>

<body>

    <!-- Navbar -->
    <header class="nav">
        <div class="nav-inner">
            <div class="nav-brand">
                🧁 <a href="{{ route('home') }}" class="link">SweetCake</a>
            </div>

            <div class="nav-right">
                @auth
                    @php $cartCount = collect(session('cart', []))->sum('jumlah'); @endphp

                    <a href="{{ route('cart.index') }}" class="icon-btn">
                        🛒
                        @if($cartCount > 0)
                            <span class="badge">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <div class="dropdown">
                        <button class="icon-btn">👤</button>

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

    <!-- CONTENT -->
    <div class="container">

        <div class="header">
            <h2 style="color:#ff2f78;">Keranjang Belanja</h2>
            <a href="{{ route('home') }}" class="btn btn-outline">Lanjut Belanja</a>
        </div>

        @if(session('success'))
            <div style="background:#e6ffed; color:#0f5132; padding:12px; border-radius:10px; margin-top:10px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#ffe6e6; color:#842029; padding:12px; border-radius:10px; margin-top:10px;">
                {{ session('error') }}
            </div>
        @endif

        @php $grandTotal = 0; @endphp

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($cart as $id => $item)
                    @php
                        $subtotal = $item['harga'] * $item['jumlah'];
                        $grandTotal += $subtotal;
                    @endphp

                    <tr>
                        <td>{{ $item['nama_produk'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>

                        <td>
                            <form method="POST" action="{{ route('cart.update', $id) }}" style="display:flex; gap:10px; align-items:center;">
                                @csrf
                                <input class="qty-input" type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="0">
                                <button class="btn btn-outline">Update</button>
                            </form>
                        </td>

                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>

                        <td>
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf
                                <button class="btn btn-outline">Hapus</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:20px;">Keranjang kosong.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="total">
            Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}
        </div>

        <div style="text-align:right; margin-top:18px;">
            <form method="POST" action="{{ route('cart.checkout') }}">
                @csrf
                <button class="btn btn-primary" {{ empty($cart) ? 'disabled' : '' }}>Checkout</button>
            </form>
        </div>

    </div>

    <!-- DROPDOWN SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const drops = document.querySelectorAll('.dropdown');

            drops.forEach(dd => {
                const btn = dd.querySelector('button');
                btn.addEventListener('click', e => {
                    e.stopPropagation();
                    dd.classList.toggle('open');
                });
            });

            document.addEventListener('click', () => {
                drops.forEach(dd => dd.classList.remove('open'));
            });
        });
    </script>

</body>
</html>
