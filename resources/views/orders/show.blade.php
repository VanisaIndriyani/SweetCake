<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $pesanan->pesanan_id }} - SweetCake</title>
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
        /* Navbar styles */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 105, 180, 0.2);
            box-shadow: 0 4px 20px rgba(255, 105, 180, 0.1);
        }
        .navbar .brand {
            font-weight: 800;
            font-size: 20px;
            color: var(--pink-400);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .navbar .brand:hover {
            transform: scale(1.05);
        }
        .navbar .brand i {
            font-size: 24px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-4px) rotate(5deg); }
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .icon-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 2px solid var(--pink-300);
            color: var(--pink-400);
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }
        .icon-btn:hover {
            background: var(--pink-100);
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }
        .badge-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, var(--pink-400), var(--pink-500));
            color: #fff;
            border-radius: 999px;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 800;
            box-shadow: 0 2px 8px rgba(255, 77, 138, 0.4);
        }
        .dropdown {
            position: relative;
        }
        .dropdown-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(255, 105, 180, 0.25);
            padding: 8px;
            display: none;
            min-width: 200px;
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-menu.show {
            display: block;
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 8px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .dropdown-item:hover {
            background: var(--pink-100);
            color: var(--pink-400);
            padding-left: 20px;
        }
        .dropdown-item button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .container {
            max-width: 1100px;
            margin: 32px auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }
        .page-head {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            border-radius: 20px;
            padding: 20px 24px;
            box-shadow: 0 10px 40px rgba(255, 105, 180, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }
        .page-title {
            font-weight: 800;
            color: var(--pink-400);
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-title i {
            font-size: 26px;
        }
        .chips {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid rgba(255, 105, 180, 0.2);
            color: #555;
            font-weight: 600;
            font-size: 14px;
        }
        .chip.status {
            background: linear-gradient(135deg, var(--pink-100), rgba(255, 182, 193, 0.3));
            color: var(--pink-400);
            border-color: var(--pink-200);
        }
        .chip i {
            font-size: 14px;
        }
        .grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 24px;
        }
        @media (max-width: 968px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(255, 105, 180, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 50px rgba(255, 105, 180, 0.25);
        }
        .card-head {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 105, 180, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.05));
        }
        .card-title {
            font-weight: 800;
            color: var(--pink-400);
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-title i {
            font-size: 20px;
        }
        .card-body {
            padding: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid rgba(255, 105, 180, 0.1);
            text-align: left;
        }
        th {
            background: linear-gradient(135deg, var(--pink-100), rgba(255, 182, 193, 0.3));
            color: var(--pink-400);
            font-weight: 700;
            font-size: 14px;
        }
        th i {
            margin-right: 8px;
        }
        tbody tr {
            transition: all 0.3s ease;
        }
        tbody tr:hover {
            background: var(--pink-100);
            transform: scale(1.01);
        }
        .muted {
            color: #666;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .muted i {
            color: var(--pink-400);
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--pink-200), var(--pink-300));
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.3);
        }
        .total {
            text-align: right;
            font-weight: 800;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 2px solid rgba(255, 105, 180, 0.2);
            color: var(--pink-400);
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .btn {
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--pink-400), var(--pink-500));
            color: #fff;
            box-shadow: 0 4px 16px rgba(255, 77, 138, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(255, 77, 138, 0.4);
        }
        .btn-light {
            background: #fff;
            border: 2px solid rgba(255, 105, 180, 0.2);
            color: #555;
        }
        .btn-light:hover {
            background: var(--pink-100);
            border-color: var(--pink-300);
            color: var(--pink-400);
            transform: translateY(-2px);
        }
        .summary-item {
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 105, 180, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .summary-item:last-child {
            border-bottom: none;
        }
        .summary-label {
            font-weight: 600;
            color: #555;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .summary-value {
            margin-left: auto;
            font-weight: 700;
            color: var(--pink-400);
        }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <i class="fas fa-birthday-cake"></i>
            <span>SweetCake</span>
        </a>
        <div class="nav-actions">
            @auth
                @php $cartCount = collect(session('cart', []))->sum('jumlah'); @endphp
            <a href="{{ route('cart.index') }}" class="icon-btn" aria-label="Keranjang">
                    <i class="fas fa-shopping-cart"></i>
                    @if($cartCount > 0)
                    <span class="badge-count">{{ $cartCount }}</span>
                    @endif
            </a>
            <div class="dropdown">
                    <button class="icon-btn" id="profileToggle" aria-expanded="false" aria-controls="profileMenu">
                        <i class="fas fa-user"></i>
                    </button>
                <div class="dropdown-menu" id="profileMenu" role="menu" aria-labelledby="profileToggle">
                        <a class="dropdown-item" href="{{ route('orders.index') }}">
                            <i class="fas fa-shopping-bag"></i>
                            Pesanan Saya
                        </a>
                        <a class="dropdown-item" href="{{ route('orders.notifications') }}">
                            <i class="fas fa-bell"></i>
                            Notifikasi
                        </a>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-edit"></i>
                            Edit Profil
                        </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                    </form>
                </div>
            </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-light" style="text-decoration: none;">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary" style="text-decoration: none;">
                    <i class="fas fa-user-plus"></i>
                    Daftar
                </a>
            @endauth
        </div>
    </header>
    <div class="container">
        <div class="page-head">
            <div class="page-title">
                <i class="fas fa-receipt"></i>
                Detail Pesanan #{{ $pesanan->pesanan_id }}
            </div>
            <div class="chips">
                <span class="chip">
                    <i class="fas fa-calendar-alt"></i>
                    Tanggal: {{ $pesanan->tanggal_pesanan }}
                </span>
                <span class="chip status">
                    <i class="fas fa-info-circle"></i>
                    Status: {{ ucfirst($pesanan->status) }}
                </span>
            </div>
        </div>

        @php $grandTotal = 0; @endphp
        @foreach($pesanan->details as $detail)
            @php $harga = $detail->produk ? $detail->produk->harga : 0; $subtotal = $harga * $detail->jumlah; $grandTotal += $subtotal; @endphp
        @endforeach

        <div class="grid">
            <div class="card">
                <div class="card-head">
                    <div class="card-title">
                        <i class="fas fa-shopping-bag"></i>
                        Item Pesanan
                    </div>
                    <div class="muted">
                        <i class="fas fa-box-open"></i>
                        Total item: {{ $pesanan->details->count() }}
                    </div>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-box"></i> Produk</th>
                                <th><i class="fas fa-money-bill-wave"></i> Harga</th>
                                <th><i class="fas fa-sort-numeric-up-alt"></i> Jumlah</th>
                                <th><i class="fas fa-dollar-sign"></i> Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->details as $detail)
                                @php $harga = $detail->produk ? $detail->produk->harga : 0; $subtotal = $harga * $detail->jumlah; @endphp
                                <tr>
                                    <td><strong>{{ $detail->produk ? $detail->produk->nama_produk : 'Produk' }}</strong></td>
                                    <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td><strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="total">
                        <i class="fas fa-receipt"></i>
                        Total: <strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-title">
                        <i class="fas fa-clipboard-list"></i>
                        Ringkasan
                    </div>
                    <div class="muted">
                        <i class="fas fa-money-bill-wave"></i>
                        Total: <strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong>
                    </div>
                </div>
                <div class="card-body">
                    @if($pesanan->pembayaran)
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="fas fa-wallet"></i>
                                Metode Pembayaran:
                            </div>
                            <div class="summary-value">
                                {{ strtoupper(str_replace('_', ' ', $pesanan->pembayaran->metode_pembayaran)) }}
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="fas fa-info-circle"></i>
                                Status Pembayaran:
                            </div>
                            <div class="summary-value">
                                <span class="badge">
                                    @if($pesanan->pembayaran->status == 'completed')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($pesanan->pembayaran->status == 'pending')
                                        <i class="fas fa-clock"></i>
                                    @else
                                        <i class="fas fa-times-circle"></i>
                                    @endif
                                    {{ ucfirst($pesanan->pembayaran->status) }}
                                </span>
                            </div>
                        </div>
                        @if($pesanan->pembayaran->bukti_pembayaran)
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="fas fa-file-image"></i>
                                Bukti Pembayaran:
                            </div>
                            <div class="summary-value">
                                <a href="{{ asset('storage/'.$pesanan->pembayaran->bukti_pembayaran) }}" target="_blank" style="color: var(--pink-400); text-decoration: none;">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="fas fa-exclamation-circle"></i>
                                Status:
                            </div>
                            <div class="summary-value">
                                Belum ada konfirmasi pembayaran
                            </div>
                        </div>
                    @endif
                    <div class="actions" style="margin-top:20px;">
                        <a href="{{ route('orders.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Pesanan
                        </a>
                        @if(!$pesanan->pembayaran)
                            <a href="{{ route('payment.create', $pesanan->pesanan_id) }}" class="btn btn-primary">
                                <i class="fas fa-credit-card"></i>
                                Bayar Sekarang
                            </a>
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