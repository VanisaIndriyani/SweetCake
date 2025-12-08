<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // Buat notifikasi otomatis untuk pelanggan
        $statusMessages = [
            'baru' => 'Pesanan #' . $id . ' telah diterima dan sedang diproses.',
            'diproses' => 'Pesanan #' . $id . ' sedang dalam proses pembuatan.',
            'selesai' => 'Pesanan #' . $id . ' telah selesai dan siap diambil!',
        ];

        Notifikasi::create([
            'pesanan_id' => $id,
            'pesan' => $statusMessages[$request->input('status')] ?? 'Status pesanan #' . $id . ' telah diperbarui.',
            'tanggal_kirim' => now(),
        ]);

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
     * Halaman form tambah produk.
     */
    public function createProduct()
    {
        return view('admin.products.create');
    }

    /**
     * Simpan produk baru.
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('img', 'public');
            $data['foto'] = $fotoPath;
        }

        Produk::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Halaman form edit produk.
     */
    public function editProduct($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.products.edit', compact('produk'));
    }

    /**
     * Update produk.
     */
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        $data = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $foto = $request->file('foto');
            $fotoPath = $foto->store('img', 'public');
            $data['foto'] = $fotoPath;
        }

        $produk->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk.
     */
    public function destroyProduct($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus foto jika ada
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Halaman notifikasi admin - menampilkan semua notifikasi yang telah dikirim
     */
    public function notifications()
    {
        $notifications = Notifikasi::with(['pesanan.user'])
            ->orderBy('tanggal_kirim', 'desc')
            ->limit(100)
            ->get();
        
        $pesanan = Pesanan::with('user')
            ->orderBy('pesanan_id', 'desc')
            ->limit(50)
            ->get();
        
        return view('admin.notifications', compact('notifications', 'pesanan'));
    }

    /**
     * Simpan notifikasi baru untuk pelanggan
     */
    public function storeNotification(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:tb_pesanan,pesanan_id',
            'pesan' => 'required|string|max:500',
        ]);

        Notifikasi::create([
            'pesanan_id' => $request->input('pesanan_id'),
            'pesan' => $request->input('pesan'),
            'tanggal_kirim' => now(),
        ]);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notifikasi berhasil dikirim ke pelanggan!');
    }

    /**
     * Halaman laporan penjualan dengan filter harian/bulanan/tahunan.
     */
    public function reports(Request $request)
    {
        $filterType = $request->input('filter_type', 'bulanan'); // harian, bulanan, tahunan
        $filterDate = $request->input('filter_date', date('Y-m-d'));
        $filterMonth = $request->input('filter_month', date('Y-m'));
        $filterYear = $request->input('filter_year', date('Y'));

        $query = Pembayaran::where('status', 'completed');

        $data = [];
        $totalPenjualan = 0;
        $totalTransaksi = 0;

        if ($filterType === 'harian') {
            $date = Carbon::parse($filterDate);
            $query->whereDate('tanggal_pembayaran', $date);
            
            $data = Pembayaran::where('status', 'completed')
                ->whereDate('tanggal_pembayaran', $date)
                ->with('pesanan.user')
                ->orderBy('tanggal_pembayaran', 'desc')
                ->get();
            
            $totalPenjualan = $data->sum('jumlah_pembayaran');
            $totalTransaksi = $data->count();
            $periodLabel = 'Harian - ' . $date->format('d F Y');

        } elseif ($filterType === 'bulanan') {
            [$year, $month] = explode('-', $filterMonth);
            $query->whereYear('tanggal_pembayaran', $year)
                  ->whereMonth('tanggal_pembayaran', $month);
            
            $data = Pembayaran::where('status', 'completed')
                ->whereYear('tanggal_pembayaran', $year)
                ->whereMonth('tanggal_pembayaran', $month)
                ->with('pesanan.user')
                ->orderBy('tanggal_pembayaran', 'desc')
                ->get();
            
            $totalPenjualan = $data->sum('jumlah_pembayaran');
            $totalTransaksi = $data->count();
            $periodLabel = 'Bulanan - ' . Carbon::create($year, $month)->format('F Y');

        } else { // tahunan
            $query->whereYear('tanggal_pembayaran', $filterYear);
            
            $monthlyData = Pembayaran::selectRaw('YEAR(tanggal_pembayaran) as year, MONTH(tanggal_pembayaran) as month, SUM(jumlah_pembayaran) as total, COUNT(*) as count')
                ->where('status', 'completed')
                ->whereYear('tanggal_pembayaran', $filterYear)
                ->groupBy('year', 'month')
                ->orderBy('month', 'asc')
                ->get();
            
            $data = $monthlyData;
            $totalPenjualan = $monthlyData->sum('total');
            $totalTransaksi = $monthlyData->sum('count');
            $periodLabel = 'Tahunan - ' . $filterYear;
        }

        $pendingCount = Pembayaran::where('status', 'pending')->count();
        $ordersCount = Pesanan::count();

        return view('admin.reports', compact(
            'data', 
            'totalPenjualan', 
            'totalTransaksi', 
            'pendingCount', 
            'ordersCount',
            'filterType',
            'filterDate',
            'filterMonth',
            'filterYear',
            'periodLabel'
        ));
    }

    /**
     * Export laporan penjualan ke PDF
     */
    public function exportPdf(Request $request)
    {
        $filterType = $request->input('filter_type', 'bulanan');
        $filterDate = $request->input('filter_date', date('Y-m-d'));
        $filterMonth = $request->input('filter_month', date('Y-m'));
        $filterYear = $request->input('filter_year', date('Y'));

        $query = Pembayaran::where('status', 'completed');

        $data = [];
        $totalPenjualan = 0;
        $totalTransaksi = 0;

        if ($filterType === 'harian') {
            $date = Carbon::parse($filterDate);
            $data = Pembayaran::where('status', 'completed')
                ->whereDate('tanggal_pembayaran', $date)
                ->with('pesanan.user')
                ->orderBy('tanggal_pembayaran', 'desc')
                ->get();
            
            $totalPenjualan = $data->sum('jumlah_pembayaran');
            $totalTransaksi = $data->count();
            $periodLabel = 'Harian - ' . $date->format('d F Y');

        } elseif ($filterType === 'bulanan') {
            [$year, $month] = explode('-', $filterMonth);
            $data = Pembayaran::where('status', 'completed')
                ->whereYear('tanggal_pembayaran', $year)
                ->whereMonth('tanggal_pembayaran', $month)
                ->with('pesanan.user')
                ->orderBy('tanggal_pembayaran', 'desc')
                ->get();
            
            $totalPenjualan = $data->sum('jumlah_pembayaran');
            $totalTransaksi = $data->count();
            $periodLabel = 'Bulanan - ' . Carbon::create($year, $month)->format('F Y');

        } else { // tahunan
            $monthlyData = Pembayaran::selectRaw('YEAR(tanggal_pembayaran) as year, MONTH(tanggal_pembayaran) as month, SUM(jumlah_pembayaran) as total, COUNT(*) as count')
                ->where('status', 'completed')
                ->whereYear('tanggal_pembayaran', $filterYear)
                ->groupBy('year', 'month')
                ->orderBy('month', 'asc')
                ->get();
            
            $data = $monthlyData;
            $totalPenjualan = $monthlyData->sum('total');
            $totalTransaksi = $monthlyData->sum('count');
            $periodLabel = 'Tahunan - ' . $filterYear;
        }

        $pdf = Pdf::loadView('admin.reports-pdf', compact(
            'data',
            'totalPenjualan',
            'totalTransaksi',
            'periodLabel',
            'filterType'
        ));

        $filename = 'laporan-penjualan-' . strtolower(str_replace(' ', '-', $periodLabel)) . '.pdf';
        
        return $pdf->download($filename);
    }
}