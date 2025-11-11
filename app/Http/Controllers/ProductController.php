<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProductController extends Controller
{
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('product.detail', compact('produk'));
    }
}