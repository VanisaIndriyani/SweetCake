@extends('admin.layout')
@section('title', 'Notifikasi - SweetCake Admin')
@section('content')
    <section class="panel" style="padding:24px;">
        <h3 style="margin-bottom:10px;">Notifikasi</h3>

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
                Belum ada notifikasi untuk ditampilkan.
            </p>
            <p style="color:#ff4d8a; font-weight:600; font-size:13px; margin-top:4px;">
                Sistem akan menampilkan notifikasi di sini jika ada aktivitas terbaru.
            </p>
        </div>
    </section>
@endsection
