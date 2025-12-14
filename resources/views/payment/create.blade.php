<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan #{{ $pesanan->pesanan_id }} - SweetCake</title>
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
        /* Navbar */
        .nav {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 105, 180, 0.2);
            box-shadow: 0 4px 20px rgba(255, 105, 180, 0.1);
            z-index: 1000;
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
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            color: var(--pink-400);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-brand:hover {
            transform: scale(1.05);
        }
        .nav-brand i {
            font-size: 24px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-4px) rotate(5deg); }
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .link {
            color: var(--pink-400);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }
        .link:hover {
            background: var(--pink-100);
            transform: translateY(-2px);
        }
        .icon-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid var(--pink-300);
            color: var(--pink-400);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .icon-btn:hover {
            background: var(--pink-100);
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }
        .badge {
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
            right: 0;
            top: 50px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(255, 105, 180, 0.25);
            min-width: 200px;
            display: none;
            overflow: hidden;
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .dropdown-menu a:hover {
            background: var(--pink-100);
            color: var(--pink-400);
            padding-left: 20px;
        }
        .dropdown.open .dropdown-menu {
            display: block;
        }
        .dropdown-menu form {
            margin: 0;
        }
        .dropdown-menu button {
            width: 100%;
            padding: 12px 16px;
            border: none;
            background: #fff;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .dropdown-menu button:hover {
            background: var(--pink-100);
            color: var(--pink-400);
            padding-left: 20px;
        }

        /* Layout */
        .wrap {
            max-width: 1100px;
            margin: 32px auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }
        .grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 24px;
            align-items: start;
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
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 50px rgba(255, 105, 180, 0.25);
        }
        .card .card-head {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 105, 180, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.05));
        }
        .card .card-body {
            padding: 24px;
        }
        .title {
            font-weight: 800;
            color: var(--pink-400);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
        }
        .title i {
            font-size: 20px;
        }

        /* Order summary table */
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
        .total {
            text-align: right;
            font-weight: 800;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 2px solid rgba(255, 105, 180, 0.2);
            color: var(--pink-400);
            font-size: 18px;
        }

        .hint {
            background: linear-gradient(135deg, var(--pink-100), rgba(255, 182, 193, 0.2));
            border: 1px dashed var(--pink-300);
            padding: 14px 16px;
            border-radius: 12px;
            color: #555;
            line-height: 1.6;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .hint i {
            color: var(--pink-400);
            margin-top: 2px;
        }
        .btn {
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
        .btn-primary:active {
            transform: translateY(0);
        }
        .upload {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .upload label {
            font-weight: 700;
            color: #555;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .upload input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 2px dashed var(--pink-300);
            border-radius: 12px;
            background: var(--pink-100);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .upload input[type="file"]:hover {
            border-color: var(--pink-400);
            background: rgba(255, 182, 193, 0.3);
        }
        select {
            padding: 12px 16px;
            border: 2px solid rgba(255, 105, 180, 0.2);
            border-radius: 12px;
            background: #fff;
            font-size: 15px;
            color: #333;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        select:focus {
            outline: none;
            border-color: var(--pink-400);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
        }
        label {
            font-weight: 700;
            color: #555;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .alert-error {
            background: linear-gradient(135deg, #ffe6e6, #ffcccc);
            color: #842029;
            border: 1px solid #ff9999;
        }
        .amount-badge {
            background: linear-gradient(135deg, var(--pink-200), var(--pink-300));
            color: #fff;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.3);
        }
    </style>
</head>
 <body>
    <!-- Navbar -->
    <header class="nav">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-birthday-cake"></i>
                <span>SweetCake</span>
            </a>
            <div class="nav-right">
                @auth
                    @php $cartCount = collect(session('cart', []))->sum('jumlah'); @endphp
                    <a href="{{ route('cart.index') }}" class="icon-btn" title="Keranjang">
                        <i class="fas fa-shopping-cart"></i>
                        @if($cartCount > 0)
                        <span class="badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown">
                        <button class="icon-btn" title="Akun" type="button">
                            <i class="fas fa-user"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('orders.index') }}">
                                <i class="fas fa-shopping-bag"></i>
                                Pesanan Saya
                            </a>
                            <a href="{{ route('orders.notifications') }}">
                                <i class="fas fa-bell"></i>
                                Notifikasi
                            </a>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-edit"></i>
                                Edit Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk
                    </a>
                    <a class="link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i>
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </header>
    <div class="wrap">
        @php
            $total = 0;
            foreach($pesanan->details as $d){ $harga = $d->produk ? $d->produk->harga : 0; $total += $harga * $d->jumlah; }
        @endphp

        <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <a href="{{ route('orders.index') }}" style="color: var(--pink-400); text-decoration: none; display: flex; align-items: center; gap: 8px; font-weight: 700; transition: all 0.3s ease;">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Pesanan
            </a>
        </div>

        <div class="grid">
            <!-- Order summary -->
            <div class="card">
                <div class="card-head">
                    <div class="title">
                        <i class="fas fa-receipt"></i>
                        Pesanan #{{ $pesanan->pesanan_id }}
                    </div>
                    <div class="amount-badge">
                        <i class="fas fa-money-bill-wave"></i>
                        Rp {{ number_format($total,0,',','.') }}
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
                            @foreach($pesanan->details as $d)
                                @php $harga = $d->produk ? $d->produk->harga : 0; $sub = $harga * $d->jumlah; @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $d->produk ? $d->produk->nama_produk : 'Produk' }}</strong>
                                    </td>
                                    <td>Rp {{ number_format($harga,0,',','.') }}</td>
                                    <td>{{ $d->jumlah }}</td>
                                    <td><strong>Rp {{ number_format($sub,0,',','.') }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="total">
                        <i class="fas fa-receipt"></i>
                        Total: <strong>Rp {{ number_format($total,0,',','.') }}</strong>
                    </div>
                </div>
            </div>

            <!-- Pembayaran -->
            <div class="card">
                <div class="card-head">
                    <div class="title">
                        <i class="fas fa-credit-card"></i>
                        Metode Pembayaran
                    </div>
                    <div class="amount-badge">
                        <i class="fas fa-money-bill-wave"></i>
                        Rp {{ number_format($total,0,',','.') }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="hint" id="payment-hint">
                        <i class="fas fa-info-circle"></i>
                        <span>Pilih metode pembayaran yang ingin Anda gunakan.</span>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('payment.store', $pesanan->pesanan_id) }}" enctype="multipart/form-data" style="margin-top:20px; display:grid; gap:16px;">
                        @csrf
                        <label for="metode_pembayaran">
                            <i class="fas fa-wallet"></i>
                            Metode Pembayaran
                        </label>
                        <select id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="transfer_bank">💳 Transfer Bank</option>
                            <option value="kartu_kredit">💳 Kartu Kredit</option>
                            <option value="cod">🏪 Pembayaran di Toko (COD)</option>
                        </select>
                        <div class="upload" id="upload-section" style="display: none;">
                            <label for="bukti">
                                <i class="fas fa-file-upload"></i>
                                Unggah Bukti Pembayaran
                            </label>
                            <input type="file" id="bukti" name="bukti" accept=".jpg,.jpeg,.png,.webp,.pdf">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            <span id="submit-text">Simpan Metode Pembayaran</span>
                        </button>
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

            // Handle payment method dropdown change
            const metodeSelect = document.getElementById('metode_pembayaran');
            const uploadSection = document.getElementById('upload-section');
            const paymentHint = document.getElementById('payment-hint');
            const submitText = document.getElementById('submit-text');
            const submitBtn = document.getElementById('submit-btn');

            if (metodeSelect) {
                metodeSelect.addEventListener('change', function() {
                    const selectedMethod = this.value;
                    const hintSpan = paymentHint.querySelector('span');
                    
                    if (selectedMethod === 'cod') {
                        uploadSection.style.display = 'none';
                        hintSpan.textContent = 'Silakan lakukan pembayaran langsung di toko saat pengambilan pesanan. Tidak perlu upload bukti sekarang.';
                        submitText.textContent = 'Konfirmasi Bayar di Toko';
                        submitBtn.querySelector('i').className = 'fas fa-check-circle';
                    } else if (selectedMethod === 'transfer_bank' || selectedMethod === 'kartu_kredit') {
                        uploadSection.style.display = 'flex';
                        hintSpan.textContent = 'Pilih metode online dan unggah bukti pembayaran (transfer/kartu). Admin akan memverifikasi.';
                        submitText.textContent = 'Kirim Bukti & Simpan Metode';
                        submitBtn.querySelector('i').className = 'fas fa-paper-plane';
                    } else {
                        uploadSection.style.display = 'none';
                        hintSpan.textContent = 'Pilih metode pembayaran yang ingin Anda gunakan.';
                        submitText.textContent = 'Simpan Metode Pembayaran';
                        submitBtn.querySelector('i').className = 'fas fa-paper-plane';
                    }
                });
            }
        });
    </script>
 </body>
 </html>