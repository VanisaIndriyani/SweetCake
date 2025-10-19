<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('produk_id', 'desc')->get();
        return view('home', compact('produk'));
    }
}