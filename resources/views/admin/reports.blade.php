@extends('admin.layout')
@section('title', 'Laporan - SweetCake Admin')
@section('content')

    <section class="panel" style="padding:24px;">
        <h3 style="margin-bottom:16px;">Laporan Penjualan</h3>

        @if(session('success'))
            <div class="alert-success" style="margin-bottom:15px;">{{ session('success') }}</div>
        @endif

        <!-- Form Filter -->
        <div style="background:#fff7fb; border:1px solid #ffd4e8; border-radius:12px; padding:20px; margin-bottom:24px;">
            <h4 style="color:#c2185b; margin-bottom:12px; font-size:16px;">🔍 Filter Laporan</h4>
            <form method="GET" action="{{ route('admin.reports.index') }}" id="filterForm">
                <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">
                    <div style="flex:1; min-width:150px;">
                        <label style="display:block; margin-bottom:6px; font-weight:600; color:#333; font-size:13px;">Jenis Laporan:</label>
                        <select name="filter_type" id="filterType" required style="width:100%; padding:8px; border:1px solid #ffbadb; border-radius:8px; font-size:14px;">
                            <option value="harian" {{ $filterType == 'harian' ? 'selected' : '' }}>Harian</option>
                            <option value="bulanan" {{ $filterType == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ $filterType == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                    </div>

                    <div id="filterHarian" style="flex:1; min-width:150px; {{ $filterType != 'harian' ? 'display:none;' : '' }}">
                        <label style="display:block; margin-bottom:6px; font-weight:600; color:#333; font-size:13px;">Pilih Tanggal:</label>
                        <input type="date" name="filter_date" value="{{ $filterDate }}" style="width:100%; padding:8px; border:1px solid #ffbadb; border-radius:8px; font-size:14px;">
                    </div>

                    <div id="filterBulanan" style="flex:1; min-width:150px; {{ $filterType != 'bulanan' ? 'display:none;' : '' }}">
                        <label style="display:block; margin-bottom:6px; font-weight:600; color:#333; font-size:13px;">Pilih Bulan:</label>
                        <input type="month" name="filter_month" value="{{ $filterMonth }}" style="width:100%; padding:8px; border:1px solid #ffbadb; border-radius:8px; font-size:14px;">
                    </div>

                    <div id="filterTahunan" style="flex:1; min-width:150px; {{ $filterType != 'tahunan' ? 'display:none;' : '' }}">
                        <label style="display:block; margin-bottom:6px; font-weight:600; color:#333; font-size:13px;">Pilih Tahun:</label>
                        <input type="number" name="filter_year" value="{{ $filterYear }}" min="2020" max="2099" style="width:100%; padding:8px; border:1px solid #ffbadb; border-radius:8px; font-size:14px;">
                    </div>

                    <div style="display:flex; gap:8px;">
                        <button type="submit" style="background:#d81b60; color:white; padding:10px 20px; border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                            Tampilkan
                        </button>
                        <button type="button" onclick="exportPdf()" style="background:#28a745; color:white; padding:10px 20px; border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                            📄 Cetak PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Statistik -->
        <div style="display:flex; gap:20px; flex-wrap:wrap; margin-bottom:22px;">
            <div style="background:#fff7fb; border-radius:14px; padding:18px 20px; flex:1; min-width:220px; border:1px solid #ffe0eb; box-shadow:0 8px 20px rgba(255,105,180,0.07);">
                <div style="font-size:14px; color:#888; margin-bottom:4px;">Total Penjualan</div>
                <div style="font-size:26px; font-weight:800; color:var(--pink-400);">
                    Rp {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}
                </div>
                <div style="font-size:12px; color:#666; margin-top:4px;">{{ $periodLabel ?? 'Semua Periode' }}</div>
            </div>

            <div style="background:#fff7fb; border-radius:14px; padding:18px 20px; flex:1; min-width:220px; border:1px solid #ffe0eb; box-shadow:0 8px 20px rgba(255,105,180,0.07);">
                <div style="font-size:14px; color:#888; margin-bottom:4px;">Total Transaksi</div>
                <div style="font-size:26px; font-weight:800; color:#28a745;">
                    {{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}
                </div>
                <div style="font-size:12px; color:#666; margin-top:4px;">Pembayaran Selesai</div>
            </div>

            <div style="background:#fff7fb; border-radius:14px; padding:18px 20px; flex:1; min-width:220px; border:1px solid #ffe0eb; box-shadow:0 8px 20px rgba(255,105,180,0.07);">
                <div style="font-size:14px; color:#888; margin-bottom:4px;">Pembayaran Pending</div>
                <div style="font-size:26px; font-weight:800; color:#b88700;">
                    {{ $pendingCount }}
                </div>
            </div>
        </div>

        <!-- Tabel Laporan -->
        @if(isset($data) && $data->count() > 0)
            <table style="margin-top:10px; width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#ffe6f3;">
                        @if($filterType == 'harian' || $filterType == 'bulanan')
                            <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">#</th>
                            <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Tanggal</th>
                            <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Pelanggan</th>
                            <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Jumlah</th>
                        @else
                            <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Bulan</th>
                            <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Total Transaksi</th>
                            <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Total Penjualan</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if($filterType == 'harian' || $filterType == 'bulanan')
                        @foreach($data as $item)
                            <tr style="border-bottom:1px solid #ffe1f0;">
                                <td style="padding:12px;">{{ $loop->iteration }}</td>
                                <td style="padding:12px;">{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y H:i') }}</td>
                                <td style="padding:12px;">{{ $item->pesanan && $item->pesanan->user ? $item->pesanan->user->nama : '-' }}</td>
                                <td style="padding:12px; color:var(--pink-400); font-weight:700;">Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($data as $item)
                            <tr style="border-bottom:1px solid #ffe1f0;">
                                <td style="padding:12px; font-weight:600; color:#555;">
                                    {{ \Carbon\Carbon::create($item->year, $item->month)->format('F Y') }}
                                </td>
                                <td style="padding:12px;">{{ $item->count }}</td>
                                <td style="padding:12px; color:var(--pink-400); font-weight:700;">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @else
            <div style="background:#fff7fb; border:1px dashed var(--pink-300); padding:22px; border-radius:14px; text-align:center; margin-top:16px;">
                <div style="font-size:42px; margin-bottom:8px;">📊</div>
                <p style="color:#999; font-size:14px; margin:0;">
                    Belum ada data penjualan untuk periode yang dipilih.
                </p>
            </div>
        @endif

    </section>

    <script>
        document.getElementById('filterType').addEventListener('change', function() {
            const type = this.value;
            document.getElementById('filterHarian').style.display = type === 'harian' ? 'block' : 'none';
            document.getElementById('filterBulanan').style.display = type === 'bulanan' ? 'block' : 'none';
            document.getElementById('filterTahunan').style.display = type === 'tahunan' ? 'block' : 'none';
        });

        function exportPdf() {
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            
            window.location.href = '{{ route("admin.reports.export") }}?' + params.toString();
        }
    </script>

@endsection
