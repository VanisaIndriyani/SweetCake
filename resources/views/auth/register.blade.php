<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun | SweetCake</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffb6c1 0%, #ff69b4 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(255, 105, 180, 0.3);
            overflow: hidden;
            max-width: 480px;
            width: 100%;
            animation: slideUp 0.5s ease-out;
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
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #ffb6c1 0%, #ff69b4 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            box-shadow: 0 10px 30px rgba(255, 182, 193, 0.4);
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
            font-size: 24px;
            color: #d63384;
            margin-bottom: 20px;
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
            background: #ffe6f2;
            color: #d63384;
            border: 1px solid #f3b6d3;
        }

        .alert-danger {
            background: #ffd6d9;
            color: #b22222;
            border: 1px solid #f5a6b2;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #d63384;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #f8c1d2;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: #fff6f9;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff69b4;
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 182, 193, 0.3);
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #ffb6c1 0%, #ff69b4 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.4);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 105, 180, 0.5);
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
            display: block;
        }
        .toggle-password {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: #d63384; cursor: pointer; font-weight: 600;
        }
        .link-home {
            display: block; text-align: center; margin-top: 16px; color: #d63384; text-decoration: none; font-weight: 600;
        }
        .link-home:hover { color: #ff69b4; text-decoration: underline; }
        .input-wrapper { position: relative; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">🧁</div>
            <div class="brand-name">SweetCake</div>
            <div class="brand-tagline">Perjalanan Manismu Dimulai di Sini</div>
        </div>

        <div class="form-container">
            <h3>Registrasi Akun</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required autocomplete="name">
                    @error('nama')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required autocomplete="new-password">
                        <button type="button" class="toggle-password" data-target="password">Tampilkan</button>
                    </div>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn">Daftar</button>
            </form>

            <a href="{{ route('home') }}" class="link-home">← Kembali ke Beranda</a>

            <div class="register-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-target');
            const input = document.getElementById(id);
            if (!input) return;
            const isPwd = input.type === 'password';
            input.type = isPwd ? 'text' : 'password';
            btn.textContent = isPwd ? 'Sembunyikan' : 'Tampilkan';
        });
    });
    </script>
</body>
</html>
