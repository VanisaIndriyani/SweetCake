@extends('admin.layout')
@section('title', 'Notifikasi - SweetCake Admin')
@section('content')
    <section class="panel" style="padding:24px;">
        <h3 style="margin-bottom:20px; display:flex; align-items:center; gap:12px; font-size:24px; font-weight:800; color:#ff4d8a;">
            <i class="fas fa-bell" style="font-size:26px; color:#ff69b4;"></i>
            Notifikasi
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
        @if(session('error'))
            <div style="
                background:linear-gradient(135deg, #ffe6e6, #ffd4d4);
                color:#842029;
                padding:14px 18px;
                border-radius:12px;
                margin-bottom:20px;
                font-size:14px;
                font-weight:600;
                box-shadow:0 4px 12px rgba(0,0,0,0.05);
                display:flex;
                align-items:center;
                gap:10px;
                border-left:4px solid #842029;
            ">
                <i class="fas fa-exclamation-circle" style="font-size:18px;"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Form untuk membuat notifikasi baru -->
        <div style="background:linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1)); border:1px solid rgba(255, 105, 180, 0.3); border-radius:16px; padding:24px; margin-bottom:28px; box-shadow:0 4px 12px rgba(255, 105, 180, 0.1);">
            <h4 style="color:#ff4d8a; margin-bottom:18px; font-size:18px; font-weight:700; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-paper-plane" style="font-size:20px;"></i>
                Kirim Notifikasi ke Pelanggan
            </h4>
            <form method="POST" action="{{ route('admin.notifications.store') }}">
                @csrf
                <div style="margin-bottom:16px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#555; font-size:14px;">
                        <i class="fas fa-shopping-cart" style="margin-right:6px; color:#ff69b4;"></i>
                        Pilih Pesanan:
                    </label>
                    <select name="pesanan_id" required style="width:100%; padding:12px 14px; border:2px solid rgba(255, 182, 193, 0.4); border-radius:10px; font-size:14px; font-weight:600; background:white; transition:all 0.3s ease;">
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->pesanan_id }}">
                                Pesanan #{{ $p->pesanan_id }} - {{ $p->user ? $p->user->nama : 'Unknown' }} ({{ ucfirst($p->status) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom:18px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#555; font-size:14px;">
                        <i class="fas fa-comment-alt" style="margin-right:6px; color:#ff69b4;"></i>
                        Pesan Notifikasi:
                    </label>
                    <textarea name="pesan" required rows="4" placeholder="Masukkan pesan notifikasi untuk pelanggan..." style="width:100%; padding:12px 14px; border:2px solid rgba(255, 182, 193, 0.4); border-radius:10px; font-size:14px; resize:vertical; font-family:inherit; transition:all 0.3s ease;"></textarea>
                </div>
                <button type="submit" style="background:linear-gradient(135deg, #ff4d8a, #ff1c78); color:white; padding:12px 24px; border:none; border-radius:10px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:8px; box-shadow:0 4px 12px rgba(255,77,138,0.3); transition:all 0.3s ease;">
                    <i class="fas fa-paper-plane"></i>
                    Kirim Notifikasi
                </button>
            </form>
        </div>

        <!-- Daftar Notifikasi yang telah dikirim -->
        <h4 style="color:#ff4d8a; margin-bottom:16px; font-size:18px; font-weight:700; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-list-alt" style="font-size:20px;"></i>
            Daftar Notifikasi Terkirim
        </h4>
        
        @if($notifications->count() > 0)
            <table style="width:100%; border-collapse:collapse; margin-top:10px;">
                <thead>
                    <tr style="background:linear-gradient(135deg, rgba(255, 182, 193, 0.2), rgba(255, 105, 180, 0.2));">
                        <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                            <i class="fas fa-hashtag"></i> #
                        </th>
                        <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                            <i class="fas fa-shopping-bag"></i> Pesanan
                        </th>
                        <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                            <i class="fas fa-user"></i> Pelanggan
                        </th>
                        <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                            <i class="fas fa-comment"></i> Pesan
                        </th>
                        <th style="padding:14px 12px; text-align:left; color:#ff4d8a; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:12px; border-bottom:2px solid rgba(255, 182, 193, 0.4);">
                            <i class="fas fa-clock"></i> Tanggal Kirim
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notif)
                        <tr style="border-bottom:1px solid rgba(255, 182, 193, 0.1); transition:all 0.2s ease;">
                            <td style="padding:14px 12px; color:#555; font-weight:600;">{{ $loop->iteration }}</td>
                            <td style="padding:14px 12px;">
                                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                    <strong style="color:#333; font-size:14px;">#{{ $notif->pesanan_id }}</strong>
                                    @if($notif->pesanan)
                                        <span class="status {{ $notif->pesanan->status }}" style="margin-left:0;">
                                            @if($notif->pesanan->status === 'baru')
                                                <i class="fas fa-circle-notch"></i>
                                            @elseif($notif->pesanan->status === 'diproses')
                                                <i class="fas fa-spinner"></i>
                                            @else
                                                <i class="fas fa-check-circle"></i>
                                            @endif
                                            {{ ucfirst($notif->pesanan->status) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td style="padding:14px 12px; color:#555; font-weight:600;">
                                <i class="fas fa-user-circle" style="color:#ff69b4; margin-right:6px;"></i>
                                {{ $notif->pesanan && $notif->pesanan->user ? $notif->pesanan->user->nama : '-' }}
                            </td>
                            <td style="padding:14px 12px; max-width:400px; color:#666;">
                                <div style="word-wrap:break-word; line-height:1.6; font-size:14px;">
                                    <i class="fas fa-quote-left" style="color:#ffb6c1; margin-right:6px; font-size:12px;"></i>
                                    {{ $notif->pesan }}
                                </div>
                            </td>
                            <td style="padding:14px 12px; color:#999; font-size:13px;">
                                <i class="far fa-calendar-alt" style="color:#ff69b4; margin-right:6px;"></i>
                                {{ \Carbon\Carbon::parse($notif->tanggal_kirim)->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <div style="
            background:linear-gradient(135deg, rgba(255, 182, 193, 0.1), rgba(255, 105, 180, 0.1));
            border:2px dashed rgba(255, 105, 180, 0.3);
            padding:40px;
            border-radius:16px;
            text-align:center;
            margin-top:20px;
            box-shadow:0 4px 14px rgba(255, 105, 180, 0.1);
        ">
            <i class="fas fa-bell-slash" style="font-size: 48px; color: #ddd; margin-bottom: 16px; display: block;"></i>
            <p style="color:#999; font-size:16px; margin:0; font-weight:600;">
                Belum ada notifikasi yang dikirim.
            </p>
            <p style="color:#ff4d8a; font-weight:600; font-size:14px; margin-top:8px;">
                <i class="fas fa-info-circle" style="margin-right:6px;"></i>
                Gunakan form di atas untuk mengirim notifikasi ke pelanggan.
            </p>
        </div>
        @endif
    </section>

    <style>
        .status {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .status i {
            font-size: 10px;
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
        
        table tbody tr:hover {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.08), rgba(255, 105, 180, 0.08));
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.1);
        }
        
        select:focus, textarea:focus {
            outline: none;
            border-color: #ff4d8a;
            box-shadow: 0 0 0 3px rgba(255, 77, 138, 0.1);
        }
        
        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 77, 138, 0.4);
        }
    </style>
@endsection
