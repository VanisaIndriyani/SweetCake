@extends('admin.layout')
@section('title', 'Admin Dashboard - SweetCake')
@section('content')

<style>
    /* ====== SweetCake Dashboard UI ====== */
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 18px;
        box-shadow: 0 6px 18px rgba(255, 105, 180, 0.20);
        transition: 0.25s ease;
        border: 1px solid #ffd2e8;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(255, 105, 180, 0.25);
    }

    .card h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #c2185b;
    }

    .card .value {
        font-size: 28px;
        font-weight: 700;
        color: #ff4f9a;
    }

    /* ===== Panel Section ===== */
    .panel {
        background: white;
        padding: 20px;
        border-radius: 18px;
        box-shadow: 0 6px 18px rgba(255, 105, 180, 0.15);
        border: 1px solid #ffd2e8;
    }

    .panel h3 {
        margin-bottom: 15px;
        font-size: 20px;
        color: #c2185b;
        font-weight: 700;
    }

    /* ===== Table Styling ===== */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 14px;
    }

    table thead tr {
        background: #ffebf4;
    }

    table thead th {
        padding: 12px;
        font-size: 14px;
        color: #c2185b;
        font-weight: 700;
        border-bottom: 2px solid #ffc5df;
        text-align: left;
    }

    table tbody td {
        padding: 12px;
        border-bottom: 1px solid #ffe6f1;
    }

    table tbody tr:hover {
        background: #fff7fb;
        transition: 0.2s;
    }

    img.cake-thumb {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(255, 105, 180, 0.25);
    }
</style>


<section class="cards">
    <div class="card">
        <h4>Pesanan Baru</h4>
        <div class="value">{{ $pesananBaru }}</div>
    </div>
    <div class="card">
        <h4>Produk Aktif</h4>
        <div class="value">{{ $produkAktif }}</div>
    </div>
    <div class="card">
        <h4>Pembayaran Tertunda</h4>
        <div class="value">{{ $pembayaranPending }}</div>
    </div>
    <div class="card">
        <h4>Penjualan Bulan Ini</h4>
        <div class="value">
            Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}
        </div>
    </div>
</section>


<section class="panel">
    <h3>Daftar Kue</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama Kue</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $p)
            <tr>
                <td>{{ $p->produk_id }}</td>
                <td>
                    @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" 
                             alt="{{ $p->nama_produk }}" 
                             class="cake-thumb">
                    @else
                        <div style="width:48px;height:48px;border-radius:10px;background:#ffb6d6;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 10px rgba(255,105,180,0.25);">
                            🍰
                        </div>
                    @endif
                </td>
                <td>{{ $p->nama_produk }}</td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>{{ $p->stok }}</td>
                <td>{{ $p->deskripsi ? (strlen($p->deskripsi) > 60 ? substr($p->deskripsi, 0, 60).'…' : $p->deskripsi) : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:20px;color:#999;">
                    Belum ada data kue.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</section>

@endsection
