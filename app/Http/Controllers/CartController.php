<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] += 1;
        } else {
            $cart[$id] = [
                'produk_id' => $produk->produk_id,
                'nama_produk' => $produk->nama_produk,
                'harga' => $produk->harga,
                'foto' => $produk->foto,
                'jumlah' => 1,
            ];
        }

        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $jumlah = (int) $request->input('jumlah', 1);
        $jumlah = $jumlah < 0 ? 0 : $jumlah;
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            if ($jumlah === 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['jumlah'] = $jumlah;
            }
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong. Tambahkan produk terlebih dahulu.');
        }

        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'tanggal_pesanan' => now(),
            'status' => 'baru',
        ]);

        $total = 0;
        foreach ($cart as $item) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->pesanan_id,
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
                'catatan' => null,
            ]);

            $total += ($item['harga'] * $item['jumlah']);
        }

        Pembayaran::create([
            'pesanan_id' => $pesanan->pesanan_id,
            'metode_pembayaran' => 'transfer_bank',
            'jumlah_pembayaran' => $total,
            'tanggal_pembayaran' => now(),
            'status' => 'pending',
        ]);

        // Bersihkan keranjang setelah checkout
        session()->forget('cart');

        return redirect()->route('payment.create', $pesanan->pesanan_id)
            ->with('success', 'Pesanan dibuat! Silakan lakukan pembayaran dan unggah bukti.');
    }
}