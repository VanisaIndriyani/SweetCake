<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan - SweetCake</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #d81b60;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #d81b60;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
            background: #fff7fb;
            padding: 15px;
            border-radius: 5px;
        }
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .info-label {
            display: table-cell;
            width: 150px;
            font-weight: bold;
            color: #c2185b;
        }
        .info-value {
            display: table-cell;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        thead {
            background-color: #ffe6f3;
        }
        th {
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #ffbadb;
            color: #c2185b;
            font-weight: bold;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ffe1f0;
        }
        .total-row {
            background-color: #fff7fb;
            font-weight: bold;
            font-size: 14px;
        }
        .total-row td {
            padding: 12px 10px;
            border-top: 2px solid #ffbadb;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🧁 SweetCake</h1>
        <p>Laporan Penjualan</p>
        <p style="font-size: 14px; margin-top: 10px;">{{ $periodLabel }}</p>
    </div>

    <div class="info">
        <div class="info-row">
            <div class="info-label">Periode:</div>
            <div class="info-value">{{ $periodLabel }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Total Transaksi:</div>
            <div class="info-value">{{ number_format($totalTransaksi, 0, ',', '.') }} transaksi</div>
        </div>
        <div class="info-row">
            <div class="info-label">Total Penjualan:</div>
            <div class="info-value" style="font-size: 16px; font-weight: bold; color: #d81b60;">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Cetak:</div>
            <div class="info-value">{{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                @if($filterType == 'harian' || $filterType == 'bulanan')
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Pesanan ID</th>
                    <th style="text-align: right;">Jumlah</th>
                @else
                    <th>Bulan</th>
                    <th style="text-align: center;">Total Transaksi</th>
                    <th style="text-align: right;">Total Penjualan</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if($filterType == 'harian' || $filterType == 'bulanan')
                @foreach($data as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y H:i') }}</td>
                        <td>{{ $item->pesanan && $item->pesanan->user ? $item->pesanan->user->nama : '-' }}</td>
                        <td>#{{ $item->pesanan_id }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @else
                @foreach($data as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::create($item->year, $item->month)->format('F Y') }}</td>
                        <td style="text-align: center;">{{ $item->count }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endif
            <tr class="total-row">
                <td colspan="{{ $filterType == 'harian' || $filterType == 'bulanan' ? '3' : '2' }}" style="text-align: right; padding-right: 10px;">TOTAL:</td>
                <td style="text-align: right; color: #d81b60;">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak dari sistem SweetCake pada {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem.</p>
    </div>
</body>
</html>


