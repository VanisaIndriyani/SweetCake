<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - SweetCake</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fff5fa 0%, #ffe6f2 50%, #fff5fa 100%);
            background-attachment: fixed;
            margin: 0;
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

        /* Container */
        .container {
            max-width: 1100px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(255, 105, 180, 0.2);
            border: 1px solid rgba(255, 105, 180, 0.2);
            position: relative;
            z-index: 1;
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
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(255, 182, 193, 0.3);
        }
        
        .header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            color: #ff4d8a;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .header h2 i {
            font-size: 30px;
            color: #ff69b4;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.2), rgba(255, 105, 180, 0.2));
            padding: 16px 14px;
            border-bottom: 2px solid rgba(255, 182, 193, 0.4);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ff4d8a;
            font-weight: 700;
        }
        
        th i {
            margin-right: 8px;
            font-size: 14px;
        }

        td {
            padding: 18px 14px;
            border-bottom: 1px solid rgba(255, 182, 193, 0.1);
            vertical-align: middle;
        }
        
        tbody tr {
            transition: all 0.2s ease;
        }
        
        tbody tr:hover {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.08), rgba(255, 105, 180, 0.08));
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.1);
        }

        /* Buttons */
        .btn {
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .btn i {
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff4d8a, #ff1c78);
            color: #fff;
            box-shadow: 0 4px 16px rgba(255, 77, 138, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 77, 138, 0.4);
            background: linear-gradient(135deg, #ff1c78, #ff4d8a);
        }
        
        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .btn-outline {
            background: #fff;
            border: 2px solid #ff4d8a;
            color: #ff4d8a;
            box-shadow: 0 2px 8px rgba(255,105,180,0.2);
        }

        .btn-outline:hover {
            background: rgba(255, 105, 180, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255,105,180,0.3);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: #fff;
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(231, 76, 60, 0.4);
            background: linear-gradient(135deg, #c0392b, #e74c3c);
        }

        /* Qty */
        .qty-input {
            width: 70px;
            padding: 10px;
            border: 2px solid rgba(255, 182, 193, 0.4);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .qty-input:focus {
            outline: none;
            border-color: #ff4d8a;
            box-shadow: 0 0 0 3px rgba(255, 77, 138, 0.1);
        }
        
        .qty-wrapper {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* Total */
        .total-section {
            margin-top: 28px;
            padding: 24px;
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1));
            border-radius: 16px;
            border: 2px solid rgba(255, 182, 193, 0.3);
        }
        
        .total {
            text-align: right;
            font-weight: 800;
            font-size: 24px;
            color: #ff4d8a;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }
        
        .total i {
            font-size: 28px;
            color: #ff69b4;
        }

        /* Navbar */
        .nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 105, 180, 0.2);
            box-shadow: 0 4px 20px rgba(255,105,180,0.1);
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
            gap: 12px;
            color: #ff4d8a;
            font-size: 20px;
            text-decoration: none;
        }
        
        .nav-brand i {
            font-size: 24px;
            color: #ff69b4;
        }

        .link {
            color: #ff4d8a;
            text-decoration: none;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .link:hover {
            background: rgba(255, 105, 180, 0.1);
        }

        .icon-btn {
            position: relative;
            width: 42px;
            height: 42px;
            display: flex;
            font-size: 18px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid #ff4d8a;
            background: #fff;
            color: #ff4d8a;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .icon-btn:hover {
            background: #ff4d8a;
            color: #fff;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(255,77,138,0.3);
        }

        .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #ff4d8a, #ff1c78);
            color: #fff;
            padding: 4px 8px;
            font-size: 11px;
            border-radius: 50%;
            font-weight: 800;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(255,77,138,0.4);
        }

        /* Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 50px;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
            border-radius: 12px;
            border: 1px solid rgba(255, 105, 180, 0.2);
            box-shadow: 0 10px 30px rgba(255, 105, 180, .25);
            display: none;
            min-width: 200px;
            overflow: hidden;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            text-decoration: none;
            color: #333;
            background: #fff;
            font-size: 14px;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .dropdown-menu a i,
        .dropdown-menu button i {
            width: 18px;
            color: #ff69b4;
        }
        
        .dropdown-menu button i {
            color: #e74c3c;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: rgba(255, 182, 193, 0.2);
            color: #ff4d8a;
        }
        
        .dropdown-menu button:hover {
            color: #e74c3c;
        }

        .dropdown.open .dropdown-menu {
            display: block;
            animation: fadeInDown 0.3s ease;
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .product-name {
            font-weight: 700;
            color: #333;
            font-size: 15px;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(255,105,180,0.25);
            border: 2px solid rgba(255,105,180,0.2);
        }
        
        .product-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .price-cell {
            color: #ff4d8a;
            font-weight: 700;
            font-size: 15px;
        }
        
        .subtotal-cell {
            color: #ff4d8a;
            font-weight: 800;
            font-size: 16px;
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

    <!-- CONTENT -->
    <div class="container">

        <div class="header">
            <h2>
                <i class="fas fa-shopping-cart"></i>
                Keranjang Belanja
            </h2>
            <a href="{{ route('home') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Lanjut Belanja
            </a>
        </div>

        @if(session('success'))
            <div style="
                background:linear-gradient(135deg, #d1e7dd, #c3e6d0);
                color:#0f5132;
                padding:14px 18px;
                border-radius:12px;
                margin-top:16px;
                font-size:14px;
                font-weight:600;
                box-shadow:0 4px 12px rgba(0,0,0,0.05);
                display:flex;
                align-items:center;
                gap:10px;
                border-left:4px solid #0f5132;
            ">
                <i class="fas fa-check-circle" style="font-size:18px;"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="
                background:linear-gradient(135deg, #ffe6e6, #ffd4d4);
                color:#842029;
                padding:14px 18px;
                border-radius:12px;
                margin-top:16px;
                font-size:14px;
                font-weight:600;
                box-shadow:0 4px 12px rgba(0,0,0,0.05);
                display:flex;
                align-items:center;
                gap:10px;
                border-left:4px solid #842029;
            ">
                <i class="fas fa-exclamation-circle" style="font-size:18px;"></i>
                {{ session('error') }}
            </div>
        @endif

        @php $grandTotal = 0; @endphp

        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-box"></i> Produk</th>
                    <th><i class="fas fa-money-bill-wave"></i> Harga</th>
                    <th><i class="fas fa-sort-numeric-up"></i> Jumlah</th>
                    <th><i class="fas fa-calculator"></i> Subtotal</th>
                    <th><i class="fas fa-cog"></i> Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($cart as $id => $item)
                    @php
                        $subtotal = $item['harga'] * $item['jumlah'];
                        $grandTotal += $subtotal;
                        
                        // Handle image path
                        $imagePath = null;
                        if (!empty($item['foto'])) {
                            if (strpos($item['foto'], 'img/') === 0) {
                                $imagePath = asset('storage/'.$item['foto']);
                            } else {
                                $imagePath = file_exists(public_path('storage/'.$item['foto'])) 
                                    ? asset('storage/'.$item['foto']) 
                                    : asset($item['foto']);
                            }
                        }
                    @endphp

                    <tr>
                        <td>
                            <div class="product-cell">
                                @if($imagePath)
                                    <img src="{{ $imagePath }}" alt="{{ $item['nama_produk'] }}" class="product-image">
                                @else
                                    <div style="width:60px;height:60px;border-radius:12px;background:linear-gradient(135deg, #ffb6c1, #ff69b4);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(255,105,180,0.25);">
                                        <i class="fas fa-birthday-cake" style="color: white; font-size: 24px;"></i>
                                    </div>
                                @endif
                                <span class="product-name">{{ $item['nama_produk'] }}</span>
                            </div>
                        </td>
                        <td class="price-cell">
                            <i class="fas fa-money-bill-wave" style="margin-right: 6px; color: #ff69b4;"></i>
                            Rp {{ number_format($item['harga'], 0, ',', '.') }}
                        </td>

                        <td>
                            <form method="POST" action="{{ route('cart.update', $id) }}" class="qty-wrapper">
                                @csrf
                                <input class="qty-input" type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" required>
                                <button type="submit" class="btn btn-outline" style="padding: 10px 14px;">
                                    <i class="fas fa-sync-alt"></i>
                                    Update
                                </button>
                            </form>
                        </td>

                        <td class="subtotal-cell">
                            <i class="fas fa-calculator" style="margin-right: 6px; color: #ff69b4;"></i>
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </td>

                        <td>
                            <form method="POST" action="{{ route('cart.remove', $id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus produk ini dari keranjang?');">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:60px 20px;">
                            <i class="fas fa-shopping-cart" style="font-size: 64px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                            <div style="font-size: 18px; font-weight: 600; color: #999; margin-bottom: 12px;">Keranjang kosong.</div>
                            <a href="{{ route('home') }}" class="btn btn-primary" style="display: inline-flex;">
                                <i class="fas fa-arrow-left"></i>
                                Mulai Belanja
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(!empty($cart))
        <div class="total-section">
            <div class="total">
                <i class="fas fa-receipt"></i>
                <span>Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <div style="text-align:right; margin-top:24px;">
            <form method="POST" action="{{ route('cart.checkout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary" style="padding: 16px 32px; font-size: 16px;">
                    <i class="fas fa-credit-card"></i>
                    Checkout
                </button>
            </form>
        </div>
        @endif

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
