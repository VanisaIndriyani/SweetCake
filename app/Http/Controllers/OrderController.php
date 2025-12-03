<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Notifikasi;

class OrderController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['pembayaran', 'notifikasi'])
            ->where('user_id', \Auth::id())
            ->orderByDesc('pesanan_id')
            ->get();

        return view('orders.index', compact('pesanan'));
    }
    public function show($id)
    {
        $pesanan = Pesanan::with(['details.produk', 'pembayaran'])
            ->where('pesanan_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orders.show', compact('pesanan'));
    }

    /**
     * Halaman notifikasi untuk user
     */
    public function notifications()
    {
        // Ambil semua pesanan user
        $pesananIds = Pesanan::where('user_id', Auth::id())
            ->pluck('pesanan_id');

        // Ambil semua notifikasi yang terkait dengan pesanan user
        $notifications = Notifikasi::with(['pesanan'])
            ->whereIn('pesanan_id', $pesananIds)
            ->orderBy('tanggal_kirim', 'desc')
            ->get();

        return view('orders.notifications', compact('notifications'));
    }
}