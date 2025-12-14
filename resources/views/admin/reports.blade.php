@extends('admin.layout')
@section('title', 'Laporan - SweetCake Admin')
@section('content')

    <section class="panel" style="padding:24px;">
        <h3 style="margin-bottom:20px; display:flex; align-items:center; gap:12px; font-size:24px; font-weight:800; color:#ff4d8a;">
            <i class="fas fa-chart-line" style="font-size:26px; color:#ff69b4;"></i>
            Laporan Penjualan
        </h3>

        @if(session('success'))
            <div style="
                background:linear-gradient(135deg, #d1e7dd, #c3e6d0);
                color:#0f5132;
                padding:14px 18px;
                border-radius:12px;
                margin-bottom:20px;
                font-size:14px;
                font-weight:600;
                box-shadow:0 4px 12px rgba(0,0,0,0.05);
                display:flex;
                align-items:center;
                gap:10px;
                border-left:4px solid #0f5132;
            ">
                <i class="fas fa-check-circle" style="font-size:18px;"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Filter -->
        <div style="background:linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1)); border:1px solid rgba(255, 105, 180, 0.3); border-radius:16px; padding:24px; margin-bottom:28px; box-shadow:0 4px 12px rgba(255, 105, 180, 0.1);">
            <h4 style="color:#ff4d8a; margin-bottom:18px; font-size:18px; font-weight:700; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-filter" style="font-size:20px;"></i>
                Filter Laporan
            </h4>
            <form method="GET" action="{{ route('admin.reports.index') }}" id="filterForm">
                <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">
                    <div style="flex:1; min-width:150px;">
                        <label style="display:block; margin-bottom:8px; font-weight:600; color:#555; font-size:14px;">
                            <i class="fas fa-calendar-alt" style="margin-right:6px; color:#ff69b4;"></i>
                            Jenis Laporan:
                        </label>
                        <select name="filter_type" id="filterType" required style="width:100%; padding:12px 14px; border:2px solid rgba(255, 182, 193, 0.4); border-radius:10px; font-size:14px; font-weight:600; background:white; transition:all 0.3s ease;">
                            <option value="harian" {{ $filterType == 'harian' ? 'selected' : '' }}>Harian</option>
                            <option value="bulanan" {{ $filterType == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ $filterType == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                    </div>

                    <div id="filterHarian" style="flex:1; min-width:150px; {{ $filterType != 'harian' ? 'display:none;' : '' }}">
                        <label style="display:block; margin-bottom:8px; font-weight:600; color:#555; font-size:14px;">
                            <i class="fas fa-calendar-day" style="margin-right:6px; color:#ff69b4;"></i>
                            Pilih Tanggal:
                        </label>
                        <input type="date" name="filter_date" value="{{ $filterDate }}" style="width:100%; padding:12px 14px; border:2px solid rgba(255, 182, 193, 0.4); border-radius:10px; font-size:14px; font-weight:600; transition:all 0.3s ease;">
                    </div>

                    <div id="filterBulanan" style="flex:1; min-width:150px; {{ $filterType != 'bulanan' ? 'display:none;' : '' }}">
                        <label style="display:block; margin-bottom:8px; font-weight:600; color:#555; font-size:14px;">
                            <i class="fas fa-calendar-week" style="margin-right:6px; color:#ff69b4;"></i>
                            Pilih Bulan:
                        </label>
                        <input type="month" name="filter_month" value="{{ $filterMonth }}" style="width:100%; padding:12px 14px; border:2px solid rgba(255, 182, 193, 0.4); border-radius:10px; font-size:14px; font-weight:600; transition:all 0.3s ease;">
                    </div>

                    <div id="filterTahunan" style="flex:1; min-width:150px; {{ $filterType != 'tahunan' ? 'display:none;' : '' }}">
                        <label style="display:block; margin-bottom:8px; font-weight:600; color:#555; font-size:14px;">
                            <i class="fas fa-calendar" style="margin-right:6px; color:#ff69b4;"></i>
                            Pilih Tahun:
                        </label>
                        <input type="number" name="filter_year" value="{{ $filterYear }}" min="2020" max="2099" style="width:100%; padding:12px 14px; border:2px solid rgba(255, 182, 193, 0.4); border-radius:10px; font-size:14px; font-weight:600; transition:all 0.3s ease;">
                    </div>

                    <div style="display:flex; gap:10px; flex-wrap:wrap;">
                        <button type="submit" style="background:linear-gradient(135deg, #ff4d8a, #ff1c78); color:white; padding:12px 24px; border:none; border-radius:10px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:8px; box-shadow:0 4px 12px rgba(255,77,138,0.3); transition:all 0.3s ease;">
                            <i class="fas fa-search"></i>
                            Tampilkan
                        </button>
                        <button type="button" onclick="exportPdf()" style="background:linear-gradient(135deg, #28a745, #218838); color:white; padding:12px 24px; border:none; border-radius:10px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:8px; box-shadow:0 4px 12px rgba(40,167,69,0.3); transition:all 0.3s ease;">
                            <i class="fas fa-file-pdf"></i>
                            Cetak PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Statistik -->
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:20px; margin-bottom:28px;">
            <div style="background:rgba(255, 255, 255, 0.95); backdrop-filter:blur(20px); border-radius:16px; padding:24px; border:1px solid rgba(255, 182, 193, 0.3); box-shadow:0 8px 24px rgba(255,105,180,0.15); position:relative; overflow:hidden; transition:all 0.3s ease;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div>
                        <div style="font-size:13px; color:#666; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">
                            <i class="fas fa-money-bill-wave" style="margin-right:6px; color:#ff69b4;"></i>
                            Total Penjualan
                        </div>
                        <div style="font-size:32px; font-weight:800; color:#ff4d8a; line-height:1.2;">
                            Rp {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}
                        </div>
                        <div style="font-size:12px; color:#999; margin-top:8px;">
                            <i class="far fa-calendar-alt" style="margin-right:4px;"></i>
                            {{ $periodLabel ?? 'Semua Periode' }}
                        </div>
                    </div>
                    <div style="width:56px; height:56px; border-radius:14px; background:linear-gradient(135deg, #ff4d8a, #ff1c78); display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(255,77,138,0.3);">
                        <i class="fas fa-chart-line" style="color:white; font-size:24px;"></i>
                    </div>
                </div>
            </div>

            <div style="background:rgba(255, 255, 255, 0.95); backdrop-filter:blur(20px); border-radius:16px; padding:24px; border:1px solid rgba(82, 196, 26, 0.3); box-shadow:0 8px 24px rgba(40,167,69,0.15); position:relative; overflow:hidden; transition:all 0.3s ease;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div>
                        <div style="font-size:13px; color:#666; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">
                            <i class="fas fa-shopping-cart" style="margin-right:6px; color:#52c41a;"></i>
                            Total Transaksi
                        </div>
                        <div style="font-size:32px; font-weight:800; color:#28a745; line-height:1.2;">
                            {{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}
                        </div>
                        <div style="font-size:12px; color:#999; margin-top:8px;">
                            <i class="fas fa-check-circle" style="margin-right:4px; color:#52c41a;"></i>
                            Pembayaran Selesai
                        </div>
                    </div>
                    <div style="width:56px; height:56px; border-radius:14px; background:linear-gradient(135deg, #52c41a, #389e0d); display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(82,196,26,0.3);">
                        <i class="fas fa-receipt" style="color:white; font-size:24px;"></i>
                    </div>
                </div>
            </div>

            <div style="background:rgba(255, 255, 255, 0.95); backdrop-filter:blur(20px); border-radius:16px; padding:24px; border:1px solid rgba(250, 140, 22, 0.3); box-shadow:0 8px 24px rgba(250,140,22,0.15); position:relative; overflow:hidden; transition:all 0.3s ease;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div>
                        <div style="font-size:13px; color:#666; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">
                            <i class="fas fa-clock" style="margin-right:6px; color:#fa8c16;"></i>
                            Pembayaran Pending
                        </div>
                        <div style="font-size:32px; font-weight:800; color:#fa8c16; line-height:1.2;">
                            {{ $pendingCount }}
                        </div>
                        <div style="font-size:12px; color:#999; margin-top:8px;">
                            <i class="fas fa-hourglass-half" style="margin-right:4px;"></i>
                            Menunggu Verifikasi
                        </div>
                    </div>
                    <div style="width:56px; height:56px; border-radius:14px; background:linear-gradient(135deg, #fa8c16, #d46b08); display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(250,140,22,0.3);">
                        <i class="fas fa-exclamation-triangle" style="color:white; font-size:24px;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Laporan -->
        @if(isset($data) && $data->count() > 0)
            <table style="margin-top:10px; width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:linear-gradient(135deg, rgba(255, 182, 193, 0.2), rgba(255, 105, 180, 0.2));">
                        @if($filterType == 'harian' || $filterType == 'bulanan')
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-hashtag"></i> #
                            </th>
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-calendar-alt"></i> Tanggal
                            </th>
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-user"></i> Pelanggan
                            </th>
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-credit-card"></i> Metode Bayar
                            </th>
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-money-bill-wave"></i> Jumlah
                            </th>
                        @else
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-calendar"></i> Bulan
                            </th>
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-shopping-cart"></i> Total Transaksi
                            </th>
                            <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                                <i class="fas fa-chart-line"></i> Total Penjualan
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if($filterType == 'harian' || $filterType == 'bulanan')
                        @foreach($data as $item)
                            @php
                                $metode = $item->metode_pembayaran ?? '-';
                                $metodeLabel = '';
                                $metodeIcon = '';
                                $metodeColor = '#ff4d8a';
                                
                                if ($metode === 'cod') {
                                    $metodeLabel = 'COD (Bayar di Toko)';
                                    $metodeIcon = 'fa-store';
                                    $metodeColor = '#fa8c16';
                                } elseif ($metode === 'transfer_bank') {
                                    $metodeLabel = 'Transfer Bank';
                                    $metodeIcon = 'fa-university';
                                    $metodeColor = '#1890ff';
                                } elseif ($metode === 'kartu_kredit') {
                                    $metodeLabel = 'Kartu Kredit';
                                    $metodeIcon = 'fa-credit-card';
                                    $metodeColor = '#722ed1';
                                } else {
                                    $metodeLabel = ucfirst(str_replace('_', ' ', $metode));
                                    $metodeIcon = 'fa-wallet';
                                }
                            @endphp
                            <tr style="border-bottom:1px solid rgba(255, 182, 193, 0.1); transition:all 0.2s ease;">
                                <td style="padding:14px 12px; color:#555; font-weight:600;">{{ $loop->iteration }}</td>
                                <td style="padding:14px 12px; color:#555;">
                                    <i class="far fa-calendar-alt" style="color:#ff69b4; margin-right:6px;"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y H:i') }}
                                </td>
                                <td style="padding:14px 12px; color:#555; font-weight:600;">
                                    <i class="fas fa-user-circle" style="color:#ff69b4; margin-right:6px;"></i>
                                    {{ $item->pesanan && $item->pesanan->user ? $item->pesanan->user->nama : '-' }}
                                </td>
                                <td style="padding:14px 12px; color:#555; font-weight:600;">
                                    <i class="fas {{ $metodeIcon }}" style="color:{{ $metodeColor }}; margin-right:6px;"></i>
                                    <span style="color:{{ $metodeColor }};">{{ $metodeLabel }}</span>
                                </td>
                                <td style="padding:14px 12px; color:#ff4d8a; font-weight:700; font-size:14px;">
                                    <i class="fas fa-money-bill-wave" style="margin-right:6px;"></i>
                                    Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($data as $item)
                            <tr style="border-bottom:1px solid rgba(255, 182, 193, 0.1); transition:all 0.2s ease;">
                                <td style="padding:14px 12px; font-weight:600; color:#555;">
                                    <i class="fas fa-calendar" style="color:#ff69b4; margin-right:6px;"></i>
                                    {{ \Carbon\Carbon::create($item->year, $item->month)->format('F Y') }}
                                </td>
                                <td style="padding:14px 12px; color:#555; font-weight:600;">
                                    <i class="fas fa-shopping-cart" style="color:#52c41a; margin-right:6px;"></i>
                                    {{ $item->count }}
                                </td>
                                <td style="padding:14px 12px; color:#ff4d8a; font-weight:700; font-size:14px;">
                                    <i class="fas fa-chart-line" style="margin-right:6px;"></i>
                                    Rp {{ number_format($item->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @else
            <div style="background:linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1)); border:2px dashed rgba(255, 105, 180, 0.3); padding:40px; border-radius:16px; text-align:center; margin-top:20px; box-shadow:0 4px 14px rgba(255, 105, 180, 0.1);">
                <i class="fas fa-chart-bar" style="font-size: 48px; color: #ddd; margin-bottom: 16px; display: block;"></i>
                <p style="color:#999; font-size:16px; margin:0; font-weight:600;">
                    Belum ada data penjualan untuk periode yang dipilih.
                </p>
                <p style="color:#ff4d8a; font-size:14px; margin-top:8px; font-weight:600;">
                    <i class="fas fa-info-circle" style="margin-right:6px;"></i>
                    Coba pilih periode lain atau filter yang berbeda.
                </p>
            </div>
        @endif

    </section>

    <style>
        table tbody tr:hover {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.08), rgba(255, 105, 180, 0.08));
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.1);
        }
        
        select:focus, input:focus {
            outline: none;
            border-color: #ff4d8a;
            box-shadow: 0 0 0 3px rgba(255, 77, 138, 0.1);
        }
        
        button[type="submit"]:hover, button[onclick="exportPdf()"]:hover {
            transform: translateY(-2px);
        }
        
        button[type="submit"]:hover {
            box-shadow: 0 6px 16px rgba(255, 77, 138, 0.4);
        }
        
        button[onclick="exportPdf()"]:hover {
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
        }
    </style>

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
