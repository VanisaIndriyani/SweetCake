<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class OrderController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['pembayaran'])
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
}