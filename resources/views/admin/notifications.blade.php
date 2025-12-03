@extends('admin.layout')
@section('title', 'Notifikasi - SweetCake Admin')
@section('content')
    <section class="panel" style="padding:24px;">
        <h3 style="margin-bottom:20px;">Notifikasi</h3>

        @if(session('success'))
            <div class="alert-success" style="margin-bottom:15px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error" style="margin-bottom:15px;">{{ session('error') }}</div>
        @endif

        <!-- Form untuk membuat notifikasi baru -->
        <div style="background:#fff7fb; border:1px solid #ffd4e8; border-radius:12px; padding:20px; margin-bottom:24px;">
            <h4 style="color:#c2185b; margin-bottom:12px; font-size:16px;">📨 Kirim Notifikasi ke Pelanggan</h4>
            <form method="POST" action="{{ route('admin.notifications.store') }}">
                @csrf
                <div style="margin-bottom:12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600; color:#333;">Pilih Pesanan:</label>
                    <select name="pesanan_id" required style="width:100%; padding:8px; border:1px solid #ffbadb; border-radius:8px; font-size:14px;">
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->pesanan_id }}">
                                Pesanan #{{ $p->pesanan_id }} - {{ $p->user ? $p->user->nama : 'Unknown' }} ({{ ucfirst($p->status) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom:12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600; color:#333;">Pesan Notifikasi:</label>
                    <textarea name="pesan" required rows="3" placeholder="Masukkan pesan notifikasi untuk pelanggan..." style="width:100%; padding:8px; border:1px solid #ffbadb; border-radius:8px; font-size:14px; resize:vertical;"></textarea>
                </div>
                <button type="submit" style="background:#d81b60; color:white; padding:10px 20px; border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                    Kirim Notifikasi
                </button>
            </form>
        </div>

        <!-- Daftar Notifikasi yang telah dikirim -->
        <h4 style="color:#c2185b; margin-bottom:12px; font-size:16px;">📋 Daftar Notifikasi Terkirim</h4>
        
        @if($notifications->count() > 0)
            <table style="width:100%; border-collapse:collapse; margin-top:10px;">
                <thead>
                    <tr style="background:#ffe6f3;">
                        <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">#</th>
                        <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Pesanan</th>
                        <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Pelanggan</th>
                        <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Pesan</th>
                        <th style="padding:12px; text-align:left; color:#c2185b; font-weight:700; border-bottom:2px solid #ffbadb;">Tanggal Kirim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notif)
                        <tr style="border-bottom:1px solid #ffe1f0;">
                            <td style="padding:12px;">{{ $loop->iteration }}</td>
                            <td style="padding:12px;">
                                <strong>#{{ $notif->pesanan_id }}</strong>
                                @if($notif->pesanan)
                                    <span class="status {{ $notif->pesanan->status }}" style="margin-left:8px;">
                                        {{ ucfirst($notif->pesanan->status) }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding:12px;">
                                {{ $notif->pesanan && $notif->pesanan->user ? $notif->pesanan->user->nama : '-' }}
                            </td>
                            <td style="padding:12px; max-width:400px;">
                                <div style="word-wrap:break-word;">{{ $notif->pesan }}</div>
                            </td>
                            <td style="padding:12px;">
                                {{ \Carbon\Carbon::parse($notif->tanggal_kirim)->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <div style="
            background:#fff7fb;
            border:1px dashed var(--pink-300);
            padding:22px;
            border-radius:14px;
            text-align:center;
            margin-top:16px;
            box-shadow:0 4px 14px rgba(255, 105, 180, 0.10);
        ">
            <div style="font-size:42px; margin-bottom:8px;">🔔</div>
            <p style="color:#999; font-size:14px; margin:0;">
                    Belum ada notifikasi yang dikirim.
            </p>
            <p style="color:#ff4d8a; font-weight:600; font-size:13px; margin-top:4px;">
                    Gunakan form di atas untuk mengirim notifikasi ke pelanggan.
            </p>
        </div>
        @endif
    </section>

    <style>
        .status {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }
        .status.baru { background:#e3f2fd; color:#0d47a1; }
        .status.diproses { background:#fff3cd; color:#b88700; }
        .status.selesai { background:#d1e7dd; color:#0f5132; }
    </style>
@endsection
