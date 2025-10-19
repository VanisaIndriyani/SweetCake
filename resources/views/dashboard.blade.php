<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SweetCake Bakery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #fff;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .sidebar h2 {
            color: #ff4d8a;
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            margin: 8px 0;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #ffe6ee;
            color: #ff4d8a;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 40px;
        }

        header {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            background: #ff4d8a;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: #ff0066;
        }

        h1 {
            color: #ff4d8a;
            margin-top: 20px;
        }

        p {
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>🍰 SweetCake</h2>
        <a href="#">Dashboard</a>
        <a href="#">Pesanan Saya</a>
        <a href="#">Profil</a>
        <a href="#">Pengaturan</a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <header>
            <h3>Selamat Datang, {{ Auth::user()->nama }}</h3>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </header>

        <section>
            <h1>Dashboard SweetCake Bakery 🎂</h1>
            <p>Akun kamu sudah aktif dan siap digunakan untuk berbelanja manis-manis!</p>
        </section>
    </div>

</body>
</html>
