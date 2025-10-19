<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun Toko SweetCake</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #fff8f9; color: #333; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 30px;">
        <h2 style="color: #ff4081; text-align: center;">🍰 Verifikasi Akun SweetCake 🍰</h2>

        <p>Halo <strong>{{ $user->nama }}</strong>,</p>
        <p>Terima kasih sudah mendaftar di <strong>Toko SweetCake</strong>! 💖</p>
        <p>Untuk mengaktifkan akun Anda, silakan klik tombol di bawah ini:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $verifyUrl }}" 
               style="background-color: #ff4081; color: white; padding: 12px 25px; text-decoration: none; border-radius: 6px; font-weight: bold;">
                Verifikasi Sekarang
            </a>
        </div>

        <p>Jika tombol di atas tidak berfungsi, salin dan buka link berikut di browser Anda:</p>
        <p style="word-wrap: break-word; background: #f9f9f9; padding: 10px; border-radius: 6px;">{{ $verifyUrl }}</p>

        <p>Jika Anda tidak merasa mendaftar di Toko SweetCake, abaikan email ini.</p>

        <br>
        <p>Salam manis, 🍬<br><strong>Tim Toko SweetCake</strong></p>
    </div>
</body>
</html>
