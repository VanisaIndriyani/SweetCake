<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - SweetCake</title>
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
            text-decoration: none;
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
        .container {
            max-width: 800px;
            margin: 32px auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(255, 105, 180, 0.15);
        }
        .page-header {
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(255, 105, 180, 0.15);
        }
        .page-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--pink-400);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-title i {
            font-size: 30px;
        }
        .page-subtitle {
            color: #666;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #555;
            font-weight: 700;
            font-size: 14px;
        }
        label i {
            color: var(--pink-400);
            font-size: 16px;
        }
        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid rgba(255, 105, 180, 0.2);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }
        input:focus {
            outline: none;
            border-color: var(--pink-400);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
        }
        input::placeholder {
            color: #999;
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
        .btn-primary:active {
            transform: translateY(0);
        }
        .muted {
            color: #666;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .muted a {
            color: var(--pink-400);
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .muted a:hover {
            transform: translateX(-4px);
        }
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
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
        .alert-success {
            background: linear-gradient(135deg, #e6ffed, #c3f4d3);
            color: #0f5132;
            border: 1px solid #90ee90;
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--pink-400);
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .password-toggle-btn:hover {
            color: var(--pink-500);
            transform: translateY(-50%) scale(1.1);
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
        <div class="card">
            <div class="page-header">
                <div class="page-title">
                    <i class="fas fa-user-edit"></i>
                    Edit Profil
                </div>
                <div class="page-subtitle">
                    <i class="fas fa-info-circle"></i>
                    Perbarui informasi profil Anda
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert" style="background: linear-gradient(135deg, #ffe6e6, #ffcccc); color: #842029; border: 1px solid #ff9999;">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin: 8px 0 0 20px; padding: 0;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="form-group">
                    <label for="nama">
                        <i class="fas fa-user"></i>
                        Nama Lengkap
                    </label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required placeholder="Masukkan nama lengkap Anda">
                </div>
                <div class="form-group">
                    <label for="alamat">
                        <i class="fas fa-map-marker-alt"></i>
                        Alamat
                    </label>
                    <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}" placeholder="Masukkan alamat Anda">
                </div>
                <div class="form-group">
                    <label for="no_hp">
                        <i class="fas fa-phone"></i>
                        No HP
                    </label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Masukkan nomor HP Anda">
                </div>
                <div class="form-group password-toggle">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password (opsional)
                    </label>
                    <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti">
                    <button type="button" class="password-toggle-btn" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordToggleIcon"></i>
                    </button>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </form>
            <div class="muted">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Home
                </a>
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

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordToggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>