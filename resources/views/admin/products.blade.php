@extends('admin.layout')
@section('title', 'Mengelola Produk - SweetCake Admin')
@section('content')
    <section class="panel">
        <h3 style="margin-bottom:20px; display:flex; align-items:center; gap:12px; font-size:24px; font-weight:800; color:#ff4d8a;">
            <i class="fas fa-box" style="font-size:26px; color:#ff69b4;"></i>
            Mengelola Produk
        </h3>

        {{-- Alert --}}
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

        {{-- Tombol Tambah Produk --}}
        <div style="margin-bottom:20px; display:flex; justify-content:flex-end;">
            <a href="{{ route('admin.products.create') }}" class="btn" 
                style="box-shadow:0 4px 12px rgba(255,105,180,0.25); text-decoration:none; display:inline-flex; align-items:center; gap:8px; padding:12px 20px;">
                <i class="fas fa-plus-circle"></i>
                Tambah Produk
            </a>
        </div>

        {{-- Tabel Produk --}}
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag"></i> #</th>
                    <th><i class="fas fa-image"></i> Foto</th>
                    <th><i class="fas fa-tag"></i> Nama</th>
                    <th><i class="fas fa-money-bill-wave"></i> Harga</th>
                    <th><i class="fas fa-boxes"></i> Stok</th>
                    <th><i class="fas fa-align-left"></i> Deskripsi</th>
                    <th style="text-align:center;"><i class="fas fa-cog"></i> Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($produk as $p)
                <tr>
                    {{-- Nomor Urut --}}
                    <td>{{ $loop->iteration }}</td>

                    {{-- Foto --}}
                    <td>
                        @if($p->foto)
                            @php
                                // Handle both old path (public/img) and new path (storage/img)
                                if (strpos($p->foto, 'img/') === 0) {
                                    // New path: storage/img/...
                                    $imagePath = asset('storage/'.$p->foto);
                                } else {
                                    // Try storage first, fallback to direct path
                                    $imagePath = file_exists(public_path('storage/'.$p->foto)) 
                                        ? asset('storage/'.$p->foto) 
                                        : asset($p->foto);
                                }
                            @endphp
                            <img src="{{ $imagePath }}"
                                alt="{{ $p->nama_produk }}"
                                style="
                                    width:56px;height:56px;
                                    border-radius:12px;
                                    object-fit:cover;
                                    box-shadow:0 4px 12px rgba(255,105,180,0.25);
                                    border:2px solid rgba(255,105,180,0.2);
                                    transition:all 0.3s ease;
                                    cursor:pointer;
                                "
                                onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 6px 16px rgba(255,105,180,0.35)';"
                                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(255,105,180,0.25)';"
                            />
                        @else
                            <div style="
                                width:48px;height:48px;border-radius:12px;
                                background:linear-gradient(135deg, #ffb6c1, #ff69b4);
                                display:flex;align-items:center;justify-content:center;
                                box-shadow:0 4px 10px rgba(255,105,180,0.25);
                            ">
                                <i class="fas fa-birthday-cake" style="color: white; font-size: 20px;"></i>
                            </div>
                        @endif
                    </td>

                    {{-- Nama --}}
                    <td style="font-weight:600; color:#333; font-size:14px;">{{ $p->nama_produk }}</td>

                    {{-- Harga --}}
                    <td style="color:#ff4d8a; font-weight:700; font-size:14px;">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </td>

                    {{-- Stok --}}
                    <td>
                        <span style="
                            padding: 6px 12px;
                            background: linear-gradient(135deg, rgba(82, 196, 26, 0.15), rgba(82, 196, 26, 0.1));
                            color: #52c41a;
                            border-radius: 10px;
                            font-weight: 700;
                            font-size: 12px;
                            display: inline-flex;
                            align-items: center;
                            gap: 6px;
                            box-shadow: 0 2px 4px rgba(82, 196, 26, 0.2);
                        ">
                            <i class="fas fa-check-circle"></i>
                            {{ $p->stok }}
                        </span>
                    </td>

                    {{-- Deskripsi --}}
                    <td style="max-width:260px; color:#666; font-size:13px;">
                        {{ $p->deskripsi ? (strlen($p->deskripsi) > 60 ? substr($p->deskripsi, 0, 60).'…' : $p->deskripsi) : '-' }}
                    </td>

                    {{-- Tombol Aksi --}}
                    <td style="text-align:center;">
                        <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap;">
                            <a href="{{ route('admin.products.edit', $p->produk_id) }}" 
                                class="btn" 
                                style="background:linear-gradient(135deg, #4a90e2, #357abd); text-decoration:none; padding:10px 16px; font-size:13px; display:inline-flex; align-items:center; gap:6px; box-shadow:0 4px 12px rgba(74, 144, 226, 0.3);">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $p->produk_id) }}" 
                                method="POST" 
                                style="display:inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" 
                                    style="background:linear-gradient(135deg, #e74c3c, #c0392b); padding:10px 16px; font-size:13px; display:inline-flex; align-items:center; gap:6px; box-shadow:0 4px 12px rgba(231, 76, 60, 0.3);">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:#999;padding:40px;">
                        <i class="fas fa-inbox" style="font-size: 48px; color: #ddd; margin-bottom: 12px; display: block;"></i>
                        <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Belum ada data produk.</div>
                        <a href="{{ route('admin.products.create') }}" 
                            style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; background:linear-gradient(135deg, #ff4d8a, #ff1c78); color:white; text-decoration:none; border-radius:10px; font-weight:700; margin-top:12px; box-shadow:0 4px 12px rgba(255,77,138,0.3);">
                            <i class="fas fa-plus-circle"></i>
                            Tambah Produk Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
