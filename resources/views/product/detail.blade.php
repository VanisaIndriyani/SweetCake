<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $produk->nama_produk }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f8f9fa; margin:0; }
        .container { max-width: 960px; margin: 30px auto; background:#fff; border-radius: 12px; padding: 20px; box-shadow: 0 6px 20px rgba(0,0,0,.08); }
        .header { display:flex; justify-content: space-between; align-items:center; }
        .btn { border:none; padding:10px 14px; border-radius:8px; font-weight:700; cursor:pointer; }
        .btn-primary { background:#ff4d8a; color:#fff; }
        .btn-outline { background:#fff; color:#ff4d8a; border:2px solid #ff4d8a; }
        .grid { display:grid; grid-template-columns: 1fr 1fr; gap:20px; }
        .thumb { width:100%; height:320px; background:#ffe6ee; border-radius: 12px; display:flex; align-items:center; justify-content:center; overflow:hidden; }
        .thumb img { width:100%; height:100%; object-fit:cover; }
        .price { color:#ff4d8a; font-weight:800; font-size:18px; margin-top:8px; }
        .muted { color:#666; }
    </style>
    </head>
<body>
    <div class="container">
        <div class="header">
            <h2>Detail Produk</h2>
            <div>
                <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
            </div>
        </div>
        <div class="grid">
            <div class="thumb">
                @if($produk->foto)
                    <img src="{{ asset($produk->foto) }}" alt="{{ $produk->nama_produk }}">
                @else
                    <span style="font-size:64px;">🍰</span>
                @endif
            </div>
            <div>
                <h3>{{ $produk->nama_produk }}</h3>
                <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                <p class="muted">{{ $produk->deskripsi ?? 'Kue lezat dari SweetCake.' }}</p>

                @auth
                <form method="POST" action="{{ route('cart.add', $produk->produk_id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                </form>
                @else
                <a class="btn btn-primary" href="{{ route('login') }}">Masuk untuk beli</a>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>