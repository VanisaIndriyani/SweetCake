@extends('admin.layout')
@section('title', 'Pesanan Masuk - SweetCake Admin')
@section('content')

<section class="panel">

<style>
/* ================= SweetCake Admin UI =================== */
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

/* Judul */
.panel h3 {
    font-size: 24px;
    font-weight: 800;
    color: #ff4d8a;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.panel h3 i {
    font-size: 26px;
    color: #ff69b4;
}

/* Alerts */
.alert-success, .alert-error {
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.alert-success { 
    background: linear-gradient(135deg, #d1e7dd, #c3e6d0); 
    color: #0f5132; 
    border-left: 4px solid #0f5132;
}

.alert-error { 
    background: linear-gradient(135deg, #ffe6e6, #ffd4d4); 
    color: #842029; 
    border-left: 4px solid #842029;
}

.alert-success i, .alert-error i {
    font-size: 18px;
}

/* Table */
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
    color: #ff4d8a;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 12px;
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
    vertical-align: middle;
}

table tbody tr {
    transition: all 0.2s ease;
}

table tbody tr:hover {
    background: linear-gradient(135deg, rgba(255, 182, 193, 0.08), rgba(255, 105, 180, 0.08));
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(255, 105, 180, 0.1);
}

/* Badges */
.badge {
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.badge i {
    font-size: 11px;
}

.badge.pending { 
    background: linear-gradient(135deg, #fff3cd, #ffe69a); 
    color: #b88700; 
}

.badge.completed { 
    background: linear-gradient(135deg, #d1e7dd, #b3e5c7); 
    color: #0f5132; 
}

.badge.failed { 
    background: linear-gradient(135deg, #ffe6e6, #ffcccc); 
    color: #842029; 
}

/* Order Status */
.status {
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    text-transform: capitalize;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.status i {
    font-size: 11px;
}

.status.baru { 
    background: linear-gradient(135deg, #e3f2fd, #bbdefb); 
    color: #0d47a1; 
}

.status.diproses { 
    background: linear-gradient(135deg, #fff3cd, #ffe082); 
    color: #b88700; 
}

.status.selesai { 
    background: linear-gradient(135deg, #d1e7dd, #a5d6a7); 
    color: #0f5132; 
}

/* Action Buttons */
.btn {
    padding: 10px 16px;
    border-radius: 10px;
    border: none;
    font-size: 13px;
    cursor: pointer;
    background: linear-gradient(135deg, #ff4d8a, #ff1c78);
    color: white;
    font-weight: 700;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 12px rgba(255, 77, 138, 0.3);
}

.btn i {
    font-size: 12px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(255, 77, 138, 0.4);
    background: linear-gradient(135deg, #ff1c78, #ff4d8a);
}

.btn:active {
    transform: translateY(0);
}

.btn[disabled] {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn[style*="background:#0d6efd"] {
    background: linear-gradient(135deg, #0d6efd, #0a58ca) !important;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn[style*="background:#0d6efd"]:hover {
    background: linear-gradient(135deg, #0a58ca, #0d6efd) !important;
    box-shadow: 0 6px 16px rgba(13, 110, 253, 0.4);
}

.action-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
}

.action-group form {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-wrap: wrap;
}

.select {
    padding: 10px 14px;
    border: 2px solid rgba(255, 182, 193, 0.4);
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    background: white;
    color: #555;
    cursor: pointer;
    transition: all 0.3s ease;
}

.select:hover {
    border-color: rgba(255, 105, 180, 0.6);
    box-shadow: 0 2px 8px rgba(255, 105, 180, 0.2);
}

.select:focus {
    outline: none;
    border-color: #ff4d8a;
    box-shadow: 0 0 0 3px rgba(255, 77, 138, 0.1);
}

/* Notes */
.action-note {
    font-size: 11px;
    color: #999;
    font-style: italic;
    display: flex;
    align-items: center;
    gap: 4px;
}

.action-note i {
    font-size: 10px;
}
</style>

<h3>
    <i class="fas fa-shopping-cart"></i>
    Pesanan Masuk
</h3>

{{-- Alerts --}}
@if(session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th><i class="fas fa-hashtag"></i> #</th>
            <th><i class="fas fa-user"></i> Pelanggan</th>
            <th><i class="fas fa-calendar"></i> Tanggal</th>
            <th><i class="fas fa-info-circle"></i> Status Pesanan</th>
            <th><i class="fas fa-credit-card"></i> Metode Bayar</th>
            <th><i class="fas fa-money-bill-wave"></i> Status Bayar</th>
            <th><i class="fas fa-file-image"></i> Bukti</th>
            <th><i class="fas fa-cog"></i> Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pesanan as $o)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $o->user ? $o->user->nama : '-' }}</td>
            <td>{{ $o->tanggal_pesanan }}</td>

            <td>
                <span class="status {{ $o->status }}">
                    @if($o->status === 'baru')
                        <i class="fas fa-circle-notch"></i>
                    @elseif($o->status === 'diproses')
                        <i class="fas fa-spinner"></i>
                    @else
                        <i class="fas fa-check-circle"></i>
                    @endif
                    {{ $o->status }}
                </span>
            </td>

            <td>{{ $o->pembayaran ? str_replace('_',' ', $o->pembayaran->metode_pembayaran) : '-' }}</td>

            <td>
                @if($o->pembayaran)
                    <span class="badge {{ $o->pembayaran->status }}">
                        @if($o->pembayaran->status === 'pending')
                            <i class="fas fa-clock"></i>
                        @elseif($o->pembayaran->status === 'completed')
                            <i class="fas fa-check-circle"></i>
                        @else
                            <i class="fas fa-times-circle"></i>
                        @endif
                        {{ ucfirst($o->pembayaran->status) }}
                    </span>
                @else
                    <span style="color: #999;">-</span>
                @endif
            </td>

            <td>
                @if($o->pembayaran && $o->pembayaran->bukti_pembayaran)
                    <a href="{{ asset('storage/'.$o->pembayaran->bukti_pembayaran) }}"
                       target="_blank"
                       style="color:#ff4d8a;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:6px;padding:6px 12px;background:rgba(255,77,138,0.1);border-radius:8px;transition:all 0.3s ease;">
                        <i class="fas fa-eye"></i>
                        Lihat Bukti
                    </a>
                @else
                    <span style="color: #999;">-</span>
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
                        <i class="fas fa-edit"></i>
                        Ubah Status
                    </button>
                </form>

                {{-- Verifikasi Pembayaran --}}
                @if($o->pembayaran)
                @php
                    // COD bisa diverifikasi tanpa bukti, metode online perlu bukti
                    $isCod = $o->pembayaran->metode_pembayaran === 'cod';
                    $canVerify = ($o->pembayaran->status !== 'completed')
                        && ($isCod || $o->pembayaran->bukti_pembayaran);
                @endphp

                <form method="POST"
                      action="{{ route('admin.payments.verify', $o->pembayaran->pembayaran_id) }}"
                      onsubmit="return confirm('{{ $isCod ? 'Verifikasi pembayaran COD #' . $o->pembayaran->pembayaran_id . '? (Pelanggan sudah bayar di toko)' : 'Verifikasi pembayaran #' . $o->pembayaran->pembayaran_id . '?' }}')">
                    @csrf

                    <button type="submit"
                        class="btn"
                        style="background:#0d6efd"
                        {{ $canVerify ? '' : 'disabled' }}>
                        @if($o->pembayaran->status === 'completed')
                            <i class="fas fa-check-double"></i>
                            Terverifikasi
                        @else
                            <i class="fas fa-check"></i>
                            Verifikasi Bayar
                        @endif
                    </button>

                    @if(!$canVerify && $o->pembayaran->status !== 'completed')
                        <span class="action-note">
                            @if(!$isCod && !$o->pembayaran->bukti_pembayaran)
                                <i class="fas fa-exclamation-triangle"></i>
                                Tidak ada bukti pembayaran
                            @endif
                        </span>
                    @elseif($isCod && $o->pembayaran->status === 'pending')
                        <span class="action-note">
                            <i class="fas fa-info-circle"></i>
                            COD – Verifikasi setelah pelanggan bayar di toko
                        </span>
                    @endif
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align:center;color:#999;padding:40px;">
                <i class="fas fa-inbox" style="font-size: 48px; color: #ddd; margin-bottom: 12px; display: block;"></i>
                <div style="font-size: 16px; font-weight: 600;">Belum ada data pesanan.</div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

</section>
@endsection
