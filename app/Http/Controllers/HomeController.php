<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $umkm = [
            ['nama' => 'Toko Bu Siti', 'produk' => 'Kerajinan'],
            ['nama' => 'Warung Pak Joko', 'produk' => 'Makanan'],
            ['nama' => 'UD Makmur Jaya', 'produk' => 'Makanan Ringan'],
            ['nama' => 'CV Sejahtera', 'produk' => 'Minuman']
        ];

        $produk = [
            ['nama' => 'Keripik Singkong', 'harga' => 15000],
            ['nama' => 'Nasi Goreng', 'harga' => 20000],
            ['nama' => 'Kue Tradisional', 'harga' => 10000],
            ['nama' => 'Es Jeruk', 'harga' => 8000],
            ['nama' => 'Kerupuk', 'harga' => 5000],
            ['nama' => 'Dodol', 'harga' => 12000]
        ];

        return view('home', [
            'umkm' => $umkm,
            'produk' => $produk
        ]);
    }
}