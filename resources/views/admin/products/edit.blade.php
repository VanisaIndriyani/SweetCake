@extends('admin.layout')
@section('title', 'Edit Produk - SweetCake Admin')
@section('content')
    <section class="panel">
        <h3 style="margin-bottom:16px;">Edit Produk</h3>

        {{-- Alert --}}
        @if($errors->any())
            <div style="
                background:#ffe6e6;
                color:#842029;
                padding:12px 14px;
                border-radius:10px;
                margin-bottom:14px;
                font-size:14px;
            ">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $produk->produk_id) }}" method="POST" enctype="multipart/form-data" style="max-width:600px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; color:#444;">
                    Nama Produk <span style="color:#ff4d8a;">*</span>
                </label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required
                    style="width:100%; padding:10px; border:2px solid #ffe6f2; border-radius:10px; font-size:14px;"
                    placeholder="Contoh: Cupcake Strawberry">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; color:#444;">
                    Harga <span style="color:#ff4d8a;">*</span>
                </label>
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" required min="0" step="1000"
                    style="width:100%; padding:10px; border:2px solid #ffe6f2; border-radius:10px; font-size:14px;"
                    placeholder="Contoh: 25000">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; color:#444;">
                    Stok <span style="color:#ff4d8a;">*</span>
                </label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" required min="0"
                    style="width:100%; padding:10px; border:2px solid #ffe6f2; border-radius:10px; font-size:14px;"
                    placeholder="Contoh: 40">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; color:#444;">
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="4"
                    style="width:100%; padding:10px; border:2px solid #ffe6f2; border-radius:10px; font-size:14px; resize:vertical;"
                    placeholder="Deskripsi produk...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; color:#444;">
                    Foto Produk Saat Ini
                </label>
                @if($produk->foto)
                    @php
                        // Handle both old path (public/img) and new path (storage/img)
                        if (strpos($produk->foto, 'img/') === 0) {
                            // New path: storage/img/...
                            $imagePath = asset('storage/'.$produk->foto);
                        } else {
                            // Try storage first, fallback to direct path
                            $imagePath = file_exists(public_path('storage/'.$produk->foto)) 
                                ? asset('storage/'.$produk->foto) 
                                : asset($produk->foto);
                        }
                    @endphp
                    <div style="margin-bottom:10px;">
                        <img src="{{ $imagePath }}" alt="{{ $produk->nama_produk }}"
                            style="width:120px; height:120px; border-radius:10px; object-fit:cover; box-shadow:0 4px 10px rgba(255,105,180,0.25);">
                    </div>
                @else
                    <div style="padding:10px; background:#f3f3f3; border-radius:10px; color:#666;">
                        Tidak ada foto
                    </div>
                @endif
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; color:#444;">
                    Ganti Foto Produk
                </label>
                <input type="file" name="foto" accept="image/*"
                    style="width:100%; padding:10px; border:2px solid #ffe6f2; border-radius:10px; font-size:14px;">
                <small style="color:#666; font-size:12px; margin-top:4px; display:block;">
                    Format: JPG, PNG, GIF (Maks: 2MB). Kosongkan jika tidak ingin mengubah foto.
                </small>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn" style="box-shadow:0 4px 12px rgba(255,105,180,0.25);">
                    Update Produk
                </button>
                <a href="{{ route('admin.products.index') }}" 
                    style="padding:10px 18px; background:#f3f3f3; color:#444; text-decoration:none; border-radius:10px; font-weight:700; transition:.25s;">
                    Batal
                </a>
            </div>
        </form>
    </section>
@endsection

