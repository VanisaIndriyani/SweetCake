<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $produk->nama_produk }} | SweetCake</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --pink-100: #ffe6f2;
            --pink-200: #ffb6c1;
            --pink-300: #ff69b4;
            --pink-400: #ff4d8a;
            --pink-500: #ff1c78;
        }
        
        * { box-sizing: border-box; }
        
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
        
        /* Navbar */
        .nav { 
            position: sticky; top:0; 
            background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); 
            border-bottom: 1px solid rgba(255, 105, 180, 0.2); 
            box-shadow: 0 4px 20px rgba(255,105,180,0.1);
            z-index: 1000;
        }
        .nav-inner { max-width:1100px; margin:0 auto; padding:14px 24px; display:flex; align-items:center; justify-content:space-between; }
        .nav-brand { display:flex; align-items:center; gap:12px; font-weight:800; color:#ff4d8a; font-size:20px; text-decoration:none; }
        .nav-brand i { font-size: 24px; color: #ff69b4; }
        .nav-right { display:flex; align-items:center; gap:12px; }
        .link { 
            color:#ff4d8a; text-decoration:none; font-weight:700; 
            padding: 8px 16px; border-radius: 10px;
            transition: all 0.3s ease;
        }
        .link:hover { background: rgba(255, 105, 180, 0.1); }
        .icon-btn { 
            position:relative; display:inline-flex; align-items:center; justify-content:center; 
            width:42px; height:42px; border-radius:50%; 
            background:#fff; border:2px solid #ff4d8a; color:#ff4d8a; 
            cursor:pointer; transition: all 0.3s ease;
            font-size: 18px; text-decoration: none;
        }
        .icon-btn:hover { background: #ff4d8a; color: white; transform: scale(1.1); box-shadow: 0 4px 12px rgba(255,77,138,0.3); }
        .badge { 
            position:absolute; top:-8px; right:-8px; 
            background:linear-gradient(135deg, #ff4d8a, #ff1c78); 
            color:#fff; border-radius:50%; 
            padding:4px 8px; font-size:11px; font-weight:800;
            min-width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(255,77,138,0.4);
        }
        .dropdown { position:relative; }
        .dropdown-menu { 
            position:absolute; right:0; top:50px; 
            background:rgba(255,255,255,0.98); backdrop-filter: blur(20px);
            border:1px solid rgba(255, 105, 180, 0.2); border-radius:12px; 
            box-shadow:0 10px 30px rgba(255,105,180,.25); 
            min-width:200px; display:none;
            overflow: hidden;
        }
        .dropdown-menu a { 
            display:flex; align-items:center; gap:10px;
            padding:12px 16px; color:#333; text-decoration:none; 
            transition: all 0.2s ease;
        }
        .dropdown-menu a i { width: 18px; color: #ff69b4; }
        .dropdown-menu a:hover { background:rgba(255, 182, 193, 0.2); color:#ff4d8a; }
        .dropdown.open .dropdown-menu { display:block; animation: fadeInDown 0.3s ease; }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-menu form { margin:0; }
        .dropdown-menu button { 
            width:100%; padding:12px 16px; border:none; 
            background:#fff; text-align:left; cursor:pointer; 
            display: flex; align-items: center; gap: 10px;
            transition: all 0.2s ease;
        }
        .dropdown-menu button i { width: 18px; color: #e74c3c; }
        .dropdown-menu button:hover { background:rgba(255, 182, 193, 0.2); color:#e74c3c; }
        
        .container { 
            max-width: 1100px; 
            margin: 30px auto; 
            background:rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(20px);
            border-radius: 24px; 
            padding: 32px; 
            box-shadow: 0 20px 60px rgba(255,105,180,0.2);
            border: 1px solid rgba(255, 105, 180, 0.2);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.5s ease-out;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .header { 
            display:flex; 
            justify-content: space-between; 
            align-items:center; 
            margin-bottom: 28px;
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
        
        .btn { 
            border:none; 
            padding:14px 24px; 
            border-radius:12px; 
            font-weight:700; 
            cursor:pointer;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-primary { 
            background:linear-gradient(135deg, #ff4d8a, #ff1c78); 
            color:#fff; 
            box-shadow: 0 4px 16px rgba(255,77,138,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(255,77,138,0.4);
            background: linear-gradient(135deg, #ff1c78, #ff4d8a);
        }
        .btn-outline { 
            background:#fff; 
            color: #ff4d8a; 
            border:2px solid #ff4d8a; 
            box-shadow: 0 2px 8px rgba(255,105,180,0.2);
        }
        .btn-outline:hover {
            background: rgba(255, 105, 180, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255,105,180,0.3);
        }
        
        .grid { 
            display:grid; 
            grid-template-columns: 1fr 1fr; 
            gap:32px; 
            align-items: start;
        }
        
        .thumb { 
            width:100%; 
            height:420px; 
            background:linear-gradient(135deg, #ffe6ee, #ffd4e8); 
            border-radius: 20px; 
            display:flex; 
            align-items:center; 
            justify-content:center; 
            overflow:hidden;
            box-shadow: 0 12px 40px rgba(255,105,180,0.2);
            border: 2px solid rgba(255, 182, 193, 0.3);
            transition: all 0.3s ease;
        }
        
        .thumb:hover {
            transform: scale(1.02);
            box-shadow: 0 16px 50px rgba(255,105,180,0.3);
        }
        
        .thumb img { 
            width:100%; 
            height:100%; 
            object-fit:cover; 
            transition: transform 0.3s ease;
        }
        
        .thumb:hover img {
            transform: scale(1.05);
        }
        
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .product-title {
            font-size: 32px;
            font-weight: 800;
            color: #333;
            margin: 0;
            line-height: 1.2;
        }
        
        .price-section {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1));
            border-radius: 16px;
            border: 2px solid rgba(255, 182, 193, 0.3);
        }
        
        .price { 
            color:#ff4d8a; 
            font-weight:800; 
            font-size:28px; 
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .price i {
            font-size: 24px;
            color: #ff69b4;
        }
        
        .stock-info {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(135deg, rgba(82, 196, 26, 0.15), rgba(82, 196, 26, 0.1));
            color: #52c41a;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            margin-top: 8px;
        }
        
        .stock-info i {
            font-size: 16px;
        }
        
        .description {
            color:#666; 
            font-size: 16px;
            line-height: 1.8;
            margin: 0;
            padding: 20px;
            background: rgba(255, 246, 249, 0.5);
            border-radius: 16px;
            border-left: 4px solid #ff69b4;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 8px;
        }
        
        .btn i {
            font-size: 16px;
        }
        
        @media (max-width: 768px) {
            .grid { grid-template-columns: 1fr; }
            .thumb { height: 300px; }
            .product-title { font-size: 24px; }
            .price { font-size: 24px; }
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
    
    <div class="container">
        <div class="header">
            <h2>
                <i class="fas fa-info-circle"></i>
                Detail Produk
            </h2>
            <div>
                <a href="{{ route('home') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="grid">
            <div class="thumb">
                @if($produk->foto)
                    @php
                        if (strpos($produk->foto, 'img/') === 0) {
                            $imagePath = asset('storage/'.$produk->foto);
                        } else {
                            $imagePath = file_exists(public_path('storage/'.$produk->foto)) 
                                ? asset('storage/'.$produk->foto) 
                                : asset($produk->foto);
                        }
                    @endphp
                    <img src="{{ $imagePath }}" alt="{{ $produk->nama_produk }}">
                @else
                    <i class="fas fa-birthday-cake" style="font-size: 80px; color: white;"></i>
                @endif
            </div>
            <div class="product-info">
                <h3 class="product-title">{{ $produk->nama_produk }}</h3>
                
                <div class="price-section">
                    <div class="price">
                        <i class="fas fa-money-bill-wave"></i>
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </div>
                </div>
                
                <div class="stock-info">
                    <i class="fas fa-check-circle"></i>
                    Stok: {{ $produk->stok }} tersedia
                </div>
                
                <p class="description">
                    <i class="fas fa-quote-left" style="color: #ffb6c1; margin-right: 8px;"></i>
                    {{ $produk->deskripsi ?? 'Kue lezat dari SweetCake dengan kualitas premium dan rasa yang menggoda.' }}
                </p>

                <div class="action-buttons">
                    @auth
                    <form method="POST" action="{{ route('cart.add', $produk->produk_id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-cart-plus"></i>
                            Tambah ke Keranjang
                        </button>
                    </form>
                    @else
                    <a class="btn btn-primary" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk untuk beli
                    </a>
                    @endauth
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