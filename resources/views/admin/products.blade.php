@extends('admin.layout')
@section('title', 'Mengelola Produk - SweetCake Admin')
@section('content')
    <section class="panel">
        <h3 style="margin-bottom:16px;">Mengelola Produk</h3>

        {{-- Alert --}}
        @if(session('success'))
            <div style="
                background:#d1e7dd;
                color:#0f5132;
                padding:12px 14px;
                border-radius:10px;
                margin-bottom:14px;
                font-size:14px;
                box-shadow:0 4px 12px rgba(0,0,0,0.05);
            ">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol Tambah Produk --}}
        <div style="margin-bottom:16px; display:flex; justify-content:flex-end;">
            <button class="btn" disabled
                style="opacity:.7; cursor:not-allowed; box-shadow:0 4px 12px rgba(255,105,180,0.25);">
                + Tambah Produk (coming soon)
            </button>
        </div>

        {{-- Tabel Produk --}}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($produk as $p)
                <tr>
                    {{-- ID --}}
                    <td>{{ $p->produk_id }}</td>

                    {{-- Foto --}}
                    <td>
                        @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}"
                                alt="{{ $p->nama_produk }}"
                                style="
                                    width:48px;height:48px;
                                    border-radius:10px;
                                    object-fit:cover;
                                    box-shadow:0 4px 10px rgba(255,105,180,0.25);
                                "/>
                        @else
                            <div style="
                                width:48px;height:48px;border-radius:10px;
                                background:linear-gradient(135deg,var(--pink-200),var(--pink-300));
                                display:flex;align-items:center;justify-content:center;
                                font-size:20px;
                                box-shadow:0 4px 10px rgba(255,105,180,0.25);
                            ">🍰</div>
                        @endif
                    </td>

                    {{-- Nama --}}
                    <td style="font-weight:600; color:#444;">{{ $p->nama_produk }}</td>

                    {{-- Harga --}}
                    <td style="color:#ff4d8a; font-weight:700;">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </td>

                    {{-- Stok --}}
                    <td>{{ $p->stok }}</td>

                    {{-- Deskripsi --}}
                    <td style="max-width:260px; color:#666;">
                        {{ $p->deskripsi ? (strlen($p->deskripsi) > 60 ? substr($p->deskripsi, 0, 60).'…' : $p->deskripsi) : '-' }}
                    </td>

                    {{-- Tombol Aksi --}}
                    <td style="text-align:center;">
                        <div style="display:flex; gap:8px; justify-content:center;">
                            <button class="btn" disabled
                                style="opacity:.6; cursor:not-allowed; background:#aaa;">
                                Edit
                            </button>
                            <button class="btn" disabled
                                style="opacity:.6; cursor:not-allowed; background:#999;">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:#999;padding:16px;">
                        Belum ada data produk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
