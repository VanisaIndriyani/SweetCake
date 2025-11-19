@extends('admin.layout')
@section('title', 'Pesanan Masuk - SweetCake Admin')
@section('content')

<section class="panel">

<style>
/* ================= SweetCake Admin UI =================== */
.panel {
    background: #ffffff;
    padding: 22px;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(255, 105, 180, 0.12);
    border: 1px solid #ffd4e8;
}

/* Judul */
.panel h3 {
    font-size: 22px;
    font-weight: 700;
    color: #c2185b;
    margin-bottom: 18px;
}

/* Alerts */
.alert-success, .alert-error {
    padding: 12px 14px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-weight: 600;
}
.alert-success { background:#d1e7dd; color:#0f5132; }
.alert-error { background:#ffe6e6; color:#842029; }

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}

table thead tr {
    background: #ffe6f3;
}

table thead th {
    padding: 12px;
    color: #c2185b;
    font-weight: 700;
    border-bottom: 2px solid #ffbadb;
    text-align: left;
}

table tbody td {
    padding: 12px;
    border-bottom: 1px solid #ffe1f0;
}

table tbody tr:hover {
    background: #fff7fb;
    transition: 0.2s ease;
}

/* Badges */
.badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
}

.badge.pending { background:#fff3cd; color:#b88700; }
.badge.completed { background:#d1e7dd; color:#0f5132; }
.badge.failed { background:#ffe6e6; color:#842029; }

/* Order Status */
.status {
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    text-transform: capitalize;
}

.status.baru { background:#e3f2fd; color:#0d47a1; }
.status.diproses { background:#fff3cd; color:#b88700; }
.status.selesai { background:#d1e7dd; color:#0f5132; }

/* Action Buttons */
.btn {
    padding: 7px 12px;
    border-radius: 8px;
    border: none;
    font-size: 13px;
    cursor: pointer;
    background: #ff4fa8;
    color: white;
    font-weight: 600;
    transition: 0.2s;
}

.btn:hover {
    opacity: 0.85;
}

.btn[disabled] {
    opacity: 0.4;
    cursor: not-allowed;
}

.action-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.action-group form {
    display: flex;
    gap: 8px;
    align-items: center;
}

.select {
    padding: 7px 10px;
    border: 1px solid #e5b4cf;
    border-radius: 8px;
    font-size: 13px;
}

/* Notes */
.action-note {
    font-size: 11px;
    color: #777;
    font-style: italic;
}
</style>

<h3>Pesanan Masuk</h3>

{{-- Alerts --}}
@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Status Pesanan</th>
            <th>Metode Bayar</th>
            <th>Status Bayar</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pesanan as $o)
        <tr>
            <td>{{ $o->pesanan_id }}</td>
            <td>{{ $o->user ? $o->user->nama : '-' }}</td>
            <td>{{ $o->tanggal_pesanan }}</td>

            <td>
                <span class="status {{ $o->status }}">{{ $o->status }}</span>
            </td>

            <td>{{ $o->pembayaran ? str_replace('_',' ', $o->pembayaran->metode_pembayaran) : '-' }}</td>

            <td>
                @if($o->pembayaran)
                    <span class="badge {{ $o->pembayaran->status }}">
                        {{ ucfirst($o->pembayaran->status) }}
                    </span>
                @else
                    -
                @endif
            </td>

            <td>
                @if($o->pembayaran && $o->pembayaran->bukti_pembayaran)
                    <a href="{{ asset('storage/'.$o->pembayaran->bukti_pembayaran) }}"
                       target="_blank"
                       style="color:#d81b60;font-weight:600;text-decoration:underline;">
                        Lihat Bukti
                    </a>
                @else
                    -
                @endif
            </td>

            <td class="action-group">
                {{-- Update Status Pesanan --}}
                <form method="POST"
                      action="{{ route('admin.orders.updateStatus', $o->pesanan_id) }}"
                      onsubmit="return confirm('Ubah status pesanan #{{ $o->pesanan_id }}?')">
                    @csrf

                    <select name="status" class="select" {{ $o->status === 'selesai' ? 'disabled' : '' }}>
                        <option value="baru" @selected($o->status==='baru')>Baru</option>
                        <option value="diproses" @selected($o->status==='diproses')>Diproses</option>
                        <option value="selesai" @selected($o->status==='selesai')>Selesai</option>
                    </select>

                    <button type="submit" class="btn" {{ $o->status === 'selesai' ? 'disabled' : '' }}>
                        Ubah Status
                    </button>
                </form>

                {{-- Verifikasi Pembayaran --}}
                @if($o->pembayaran)
                @php
                    $canVerify = ($o->pembayaran->status !== 'completed')
                        && ($o->pembayaran->bukti_pembayaran)
                        && ($o->pembayaran->metode_pembayaran !== 'cod');
                @endphp

                <form method="POST"
                      action="{{ route('admin.payments.verify', $o->pembayaran->pembayaran_id) }}"
                      onsubmit="return confirm('Verifikasi pembayaran #{{ $o->pembayaran->pembayaran_id }}?')">
                    @csrf

                    <button type="submit"
                        class="btn"
                        style="background:#0d6efd"
                        {{ $canVerify ? '' : 'disabled' }}>
                        {{ $o->pembayaran->status === 'completed' ? 'Terverifikasi' : 'Verifikasi Bayar' }}
                    </button>

                    @if(!$canVerify)
                        <span class="action-note">
                            @if($o->pembayaran->status === 'completed') ✔ Sudah diverifikasi
                            @elseif($o->pembayaran->metode_pembayaran === 'cod') COD – Tidak perlu verifikasi
                            @elseif(!$o->pembayaran->bukti_pembayaran) Tidak ada bukti pembayaran
                            @endif
                        </span>
                    @endif
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align:center;color:#999;padding:18px;">
                Belum ada data pesanan.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

</section>
@endsection
