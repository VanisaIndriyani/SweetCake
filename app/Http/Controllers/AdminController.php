<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua produk/kue untuk ditampilkan di dashboard
        $produk = Produk::orderBy('produk_id', 'desc')->get();

        // Statistik dashboard
        $pesananBaru = Pesanan::where('status', 'baru')->count();
        $produkAktif = Produk::where('stok', '>', 0)->count();
        $pembayaranPending = Pembayaran::where('status', 'pending')->count();
        $penjualanBulanIni = Pembayaran::where('status', 'completed')
            ->whereYear('tanggal_pembayaran', now()->year)
            ->whereMonth('tanggal_pembayaran', now()->month)
            ->sum('jumlah_pembayaran');

        return view('admin.dashboard', compact(
            'produk',
            'pesananBaru',
            'produkAktif',
            'pembayaranPending',
            'penjualanBulanIni'
        ));
    }

    /**
     * Update status pesanan oleh admin: baru, diproses, selesai
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai',
        ]);

        $pesanan = Pesanan::where('pesanan_id', $id)->firstOrFail();
        $pesanan->status = $request->input('status');
        $pesanan->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan #' . $id . ' diperbarui.');
    }

    /**
     * Verifikasi pembayaran: tandai completed jika ada bukti.
     */
    public function verifyPayment($id)
    {
        $pembayaran = Pembayaran::where('pembayaran_id', $id)->firstOrFail();
        // Jika ada bukti, set completed; jika tidak, tetap pending
        if ($pembayaran->bukti_pembayaran) {
            $pembayaran->status = 'completed';
            $pembayaran->save();
            return redirect()->route('admin.orders.index')->with('success', 'Pembayaran #' . $id . ' diverifikasi.');
        }
        return redirect()->route('admin.orders.index')->with('error', 'Tidak ada bukti pembayaran untuk diverifikasi.');
    }
    /**
     * Halaman khusus daftar pesanan masuk.
     */
    public function orders()
    {
        $pesanan = Pesanan::with(['user', 'pembayaran'])
            ->orderBy('pesanan_id', 'desc')
            ->limit(100)
            ->get();
        return view('admin.orders', compact('pesanan'));
    }

    /**
     * Halaman mengelola produk.
     */
    public function products()
    {
        $produk = Produk::orderByDesc('produk_id')->get();
        return view('admin.products', compact('produk'));
    }

    /**
     * Halaman notifikasi admin (placeholder sederhana).
     */
    public function notifications()
    {
        // Placeholder: belum ada model Notifikasi, tampilkan kosong dahulu
        $notifications = [];
        return view('admin.notifications', compact('notifications'));
    }

    /**
     * Halaman laporan penjualan sederhana.
     */
    public function reports()
    {
        $monthly = Pembayaran::selectRaw('YEAR(tanggal_pembayaran) as year, MONTH(tanggal_pembayaran) as month, SUM(jumlah_pembayaran) as total')
            ->where('status', 'completed')
            ->groupBy('year','month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        $pendingCount = Pembayaran::where('status', 'pending')->count();
        $ordersCount = Pesanan::count();

        return view('admin.reports', compact('monthly', 'pendingCount', 'ordersCount'));
    }
}