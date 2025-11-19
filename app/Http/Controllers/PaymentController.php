<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class PaymentController extends Controller
{
    /**
     * Show payment page for an order where user can upload proof.
     */
    public function create($id)
    {
        $pesanan = Pesanan::with(['pembayaran'])
            ->where('pesanan_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('payment.create', compact('pesanan'));
    }

    /**
     * Store payment method choice and proof of payment.
     */
    public function store(Request $request, $id)
    {
        $pesanan = Pesanan::with(['pembayaran'])
            ->where('pesanan_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'metode_pembayaran' => 'required|in:transfer_bank,kartu_kredit,cod',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:4096',
        ]);

        $pembayaran = $pesanan->pembayaran;
        if (!$pembayaran) {
            $pembayaran = new Pembayaran();
            $pembayaran->pesanan_id = $pesanan->pesanan_id;
        }

        // Set metode sesuai pilihan user
        $pembayaran->metode_pembayaran = $validated['metode_pembayaran'];
        $pembayaran->jumlah_pembayaran = $pembayaran->jumlah_pembayaran ?? $pesanan->details->reduce(function($c,$d){
            $harga = $d->produk ? $d->produk->harga : 0; return $c + ($harga * $d->jumlah);
        }, 0);
        $pembayaran->tanggal_pembayaran = now();
        $pembayaran->status = 'pending';

        // Bukti wajib untuk metode online, opsional untuk COD
        if (in_array($validated['metode_pembayaran'], ['transfer_bank', 'kartu_kredit']) && !$request->hasFile('bukti')) {
            return back()->with('error', 'Untuk pembayaran online, silakan unggah bukti pembayaran.');
        }

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('payments', 'public');
            $pembayaran->bukti_pembayaran = $path;
        }
        $pembayaran->save();

        return redirect()->route('orders.show', $pesanan->pesanan_id)
            ->with('success', 'Metode pembayaran disimpan. Jika online, bukti dikirim dan menunggu verifikasi admin.');
    }
}