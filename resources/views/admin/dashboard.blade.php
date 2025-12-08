@extends('admin.layout')
@section('title', 'Admin Dashboard - SweetCake')
@section('content')

<style>
    /* ====== SweetCake Dashboard UI ====== */
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
        margin-bottom: 30px;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 24px;
        border-radius: 20px;
        box-shadow: 
            0 8px 24px rgba(255, 105, 180, 0.15),
            0 2px 8px rgba(255, 105, 180, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 182, 193, 0.3);
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ffb6c1, #ff69b4, #ff4d8a);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 16px 40px rgba(255, 105, 180, 0.25),
            0 4px 12px rgba(255, 105, 180, 0.15);
        border-color: rgba(255, 105, 180, 0.4);
    }

    .card:hover::before {
        transform: scaleX(1);
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .card-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .card:hover .card-icon {
        transform: rotate(10deg) scale(1.1);
    }

    .card-icon.blue {
        background: linear-gradient(135deg, #4a90e2, #357abd);
    }

    .card-icon.green {
        background: linear-gradient(135deg, #52c41a, #389e0d);
    }

    .card-icon.orange {
        background: linear-gradient(135deg, #fa8c16, #d46b08);
    }

    .card-icon.pink {
        background: linear-gradient(135deg, #ff4d8a, #ff1c78);
    }

    .card h4 {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card .value {
        font-size: 32px;
        font-weight: 800;
        color: #333;
        margin-top: 8px;
        line-height: 1.2;
    }

    .card .value small {
        font-size: 14px;
        font-weight: 500;
        color: #999;
        display: block;
        margin-top: 4px;
    }

    /* ===== Panel Section ===== */
    .panel {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 24px;
        border-radius: 20px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.08),
            0 2px 8px rgba(255, 105, 180, 0.1);
        border: 1px solid rgba(255, 105, 180, 0.1);
    }

    .panel h3 {
        margin-bottom: 20px;
        font-size: 22px;
        color: #ff4d8a;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .panel h3 i {
        font-size: 24px;
        color: #ff69b4;
    }

    /* ===== Table Styling ===== */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 14px;
    }

    table thead tr {
        background: linear-gradient(135deg, rgba(255, 182, 193, 0.2), rgba(255, 105, 180, 0.2));
    }

    table thead th {
        padding: 14px 12px;
        font-size: 12px;
        color: #ff4d8a;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(255, 182, 193, 0.4);
        text-align: left;
    }

    table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    table tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid rgba(255, 182, 193, 0.1);
        color: #555;
    }

    table tbody tr {
        transition: all 0.2s ease;
    }

    table tbody tr:hover {
        background: linear-gradient(135deg, rgba(255, 182, 193, 0.08), rgba(255, 105, 180, 0.08));
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(255, 105, 180, 0.1);
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
        <div class="card-header">
            <div>
                <h4>Pesanan Baru</h4>
                <div class="value">{{ $pesananBaru }}</div>
            </div>
            <div class="card-icon blue">
                <i class="fas fa-shopping-bag"></i>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div>
                <h4>Produk Aktif</h4>
                <div class="value">{{ $produkAktif }}</div>
            </div>
            <div class="card-icon green">
                <i class="fas fa-box-open"></i>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div>
                <h4>Pembayaran Tertunda</h4>
                <div class="value">{{ $pembayaranPending }}</div>
            </div>
            <div class="card-icon orange">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div>
                <h4>Penjualan Bulan Ini</h4>
                <div class="value">
                    Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}
                </div>
            </div>
            <div class="card-icon pink">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
</section>


<section class="panel">
    <h3>
        <i class="fas fa-birthday-cake"></i>
        Daftar Kue
    </h3>

    <table>
        <thead>
            <tr>
                <th>#</th>
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
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($p->foto)
                        @php
                            if (strpos($p->foto, 'img/') === 0) {
                                $imagePath = asset('storage/'.$p->foto);
                            } else {
                                $imagePath = file_exists(public_path('storage/'.$p->foto)) 
                                    ? asset('storage/'.$p->foto) 
                                    : asset($p->foto);
                            }
                        @endphp
                        <img src="{{ $imagePath }}" 
                             alt="{{ $p->nama_produk }}" 
                             class="cake-thumb">
                    @else
                        <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg, #ffb6c1, #ff69b4);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 10px rgba(255,105,180,0.25);">
                            <i class="fas fa-birthday-cake" style="color: white; font-size: 20px;"></i>
                        </div>
                    @endif
                </td>
                <td style="font-weight: 600; color: #333;">{{ $p->nama_produk }}</td>
                <td style="color: #ff4d8a; font-weight: 700;">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>
                    <span style="padding: 4px 10px; background: rgba(82, 196, 26, 0.1); color: #52c41a; border-radius: 8px; font-weight: 600; font-size: 12px;">
                        <i class="fas fa-check-circle"></i> {{ $p->stok }}
                    </span>
                </td>
                <td>{{ $p->deskripsi ? (strlen($p->deskripsi) > 60 ? substr($p->deskripsi, 0, 60).'…' : $p->deskripsi) : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:40px;color:#999;">
                    <i class="fas fa-inbox" style="font-size: 48px; color: #ddd; margin-bottom: 12px; display: block;"></i>
                    <div style="font-size: 16px; font-weight: 600;">Belum ada data kue.</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</section>

@endsection
