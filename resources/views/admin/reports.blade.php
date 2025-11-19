@extends('admin.layout')
@section('title', 'Laporan - SweetCake Admin')
@section('content')

    <section class="panel" style="padding:24px;">
        <h3 style="margin-bottom:16px;">Laporan Penjualan</h3>

        {{-- Kartu Statistik --}}
        <div style="display:flex; gap:20px; flex-wrap:wrap; margin-bottom:22px;">

            <div style="
                background:#fff7fb;
                border-radius:14px;
                padding:18px 20px;
                flex:1;
                min-width:220px;
                border:1px solid #ffe0eb;
                box-shadow:0 8px 20px rgba(255,105,180,0.07);
            ">
                <div style="font-size:14px; color:#888; margin-bottom:4px;">Total Pesanan</div>
                <div style="font-size:26px; font-weight:800; color:var(--pink-400);">
                    {{ $ordersCount }}
                </div>
            </div>

            <div style="
                background:#fff7fb;
                border-radius:14px;
                padding:18px 20px;
                flex:1;
                min-width:220px;
                border:1px solid #ffe0eb;
                box-shadow:0 8px 20px rgba(255,105,180,0.07);
            ">
                <div style="font-size:14px; color:#888; margin-bottom:4px;">Pembayaran Pending</div>
                <div style="font-size:26px; font-weight:800; color:#b88700;">
                    {{ $pendingCount }}
                </div>
            </div>

        </div>

        {{-- Tabel Laporan --}}
        <table style="margin-top:10px;">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($monthly as $m)
                <tr>
                    <td style="font-weight:600; color:#555;">
                        {{ str_pad($m->month, 2, '0', STR_PAD_LEFT) }}/{{ $m->year }}
                    </td>
                    <td style="color:var(--pink-400); font-weight:700;">
                        Rp {{ number_format($m->total, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align:center; padding:20px; color:#888;">
                        Belum ada data penjualan yang terverifikasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </section>

@endsection
