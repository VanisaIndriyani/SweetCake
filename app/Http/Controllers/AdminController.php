<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Produk;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua produk/kue untuk ditampilkan di halaman admin
        $produk = Produk::orderBy('produk_id', 'desc')->get();

        return view('admin.dashboard', compact('produk'));
    }
}