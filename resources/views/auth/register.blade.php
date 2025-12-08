<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun | SweetCake</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fff5fa 0%, #ffe6f2 50%, #fff5fa 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
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
                radial-gradient(circle at 20% 50%, rgba(255, 105, 180, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 77, 138, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255, 182, 193, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 28px;
            box-shadow: 0 20px 60px rgba(255, 105, 180, 0.3);
            border: 1px solid rgba(255, 105, 180, 0.2);
            overflow: hidden;
            max-width: 480px;
            width: 100%;
            animation: slideUp 0.5s ease-out;
            position: relative;
            z-index: 1;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            padding: 50px 30px 40px;
            background: white;
        }

        .logo {
            width: 90px;
            height: 90px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #ffb6c1 0%, #ff69b4 50%, #ff4d8a 100%);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 44px;
            box-shadow: 0 12px 36px rgba(255, 182, 193, 0.5);
            transition: all 0.3s ease;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(5deg); }
        }
        
        .logo:hover {
            transform: scale(1.1) rotate(10deg);
            animation: none;
        }
        
        .logo i {
            color: white;
        }

        .brand-name {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .brand-tagline {
            color: #888;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .form-container {
            padding: 0 40px 50px;
        }

        h3 {
            text-align: center;
            font-size: 26px;
            color: #ff4d8a;
            margin-bottom: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        h3 i {
            font-size: 24px;
            color: #ff69b4;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin: 20px 0;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1e7dd, #c3e6d0);
            color: #0f5132;
            border-left: 4px solid #0f5132;
        }
        
        .alert-success i {
            font-size: 18px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffe6e6, #ffd4d4);
            color: #842029;
            border-left: 4px solid #842029;
        }
        
        .alert-danger i {
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: #ff4d8a;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .form-group label i {
            font-size: 16px;
            color: #ff69b4;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px 16px 48px;
            border: 2px solid rgba(255, 182, 193, 0.4);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: rgba(255, 246, 249, 0.8);
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff69b4;
            font-size: 18px;
            z-index: 1;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff4d8a;
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 77, 138, 0.15);
        }
        
        .form-group input:focus + i,
        .input-wrapper:focus-within i {
            color: #ff4d8a;
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #ff4d8a 0%, #ff1c78 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px rgba(255, 77, 138, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(255, 77, 138, 0.5);
            background: linear-gradient(135deg, #ff1c78 0%, #ff4d8a 100%);
        }
        
        .btn i {
            font-size: 18px;
        }

        .btn:active { transform: translateY(0); }

        .register-link {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 20px;
        }

        .register-link a {
            color: #d63384;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #ff69b4;
            text-decoration: underline;
        }

        .error-text {
            color: #ff4d6d;
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .error-text i {
            font-size: 12px;
        }
        .toggle-password {
            position: absolute; 
            right: 14px; 
            top: 50%; 
            transform: translateY(-50%);
            background: none; 
            border: none; 
            color: #ff4d8a; 
            cursor: pointer; 
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .toggle-password:hover {
            background: rgba(255, 105, 180, 0.1);
            color: #ff1c78;
        }
        
        .toggle-password i {
            font-size: 14px;
        }
        .link-home {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-align: center; 
            margin-top: 16px; 
            color: #ff4d8a; 
            text-decoration: none; 
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .link-home:hover { 
            color: #ff1c78; 
            text-decoration: underline; 
        }
        
        .link-home i {
            font-size: 14px;
        }
        
        .register-link a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .register-link a i {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-birthday-cake"></i>
            </div>
            <div class="brand-name">SweetCake</div>
            <div class="brand-tagline">
                <i class="fas fa-heart" style="color: #ff69b4; margin-right: 6px;"></i>
                Perjalanan Manismu Dimulai di Sini
            </div>
        </div>

        <div class="form-container">
            <h3>
                <i class="fas fa-user-plus"></i>
                Registrasi Akun
            </h3>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">
                        <i class="fas fa-user"></i>
                        Nama Lengkap
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required autocomplete="name">
                    </div>
                    @error('nama')
                        <span class="error-text">
                            <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Alamat Email
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Masukkan email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')
                        <span class="error-text">
                            <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Kata Sandi
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required autocomplete="new-password">
                        <button type="button" class="toggle-password" data-target="password">
                            <i class="fas fa-eye"></i>
                            <span>Tampilkan</span>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-text">
                            <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-user-plus"></i>
                    Daftar
                </button>
            </form>

            <a href="{{ route('home') }}" class="link-home">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Beranda
            </a>

            <div class="register-link">
                Sudah punya akun? <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    Login di sini
                </a>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-target');
            const input = document.getElementById(id);
            if (!input) return;
            const icon = btn.querySelector('i');
            const span = btn.querySelector('span');
            const isPwd = input.type === 'password';
            input.type = isPwd ? 'text' : 'password';
            if (icon) {
                icon.className = isPwd ? 'fas fa-eye-slash' : 'fas fa-eye';
            }
            if (span) {
                span.textContent = isPwd ? 'Sembunyikan' : 'Tampilkan';
            }
        });
    });
    </script>
</body>
</html>
