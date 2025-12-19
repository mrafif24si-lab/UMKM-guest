<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data produk dari database
        $produkTerbaik = Produk::with(['umkm', 'media'])
            ->where('status', 'Aktif') // Hanya tampilkan produk aktif
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan yang terbaru
            ->take(20) // Batasi jumlah yang ditampilkan
            ->get();
         
        return view('pages.guest.dashboard', compact('produkTerbaik'));
    }

    /**
     * Menampilkan halaman Tentang Kami
     * Method ini ditambahkan untuk mengatasi error "Call to undefined method"
     */
    public function tentang()
    {
        // Pastikan Anda sudah membuat file view di: resources/views/pages/guest/tentang.blade.php
        // Jika nama file atau foldernya berbeda, sesuaikan bagian di dalam kurung view('...')
        return view('pages.guest.tentang');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}