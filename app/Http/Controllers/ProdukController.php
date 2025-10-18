<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;  
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataProduk = Produk::with('umkm')->get(); // Perbaiki: 'umkm' bukan 'Umkm'
        return view('produk.index', compact('dataProduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tidak perlu kirim data UMKM karena menggunakan input text
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data['nama_produk'] = $request->nama_produk;
		$data['deksripsi'] = $request->deksripsi;
		$data['jenis_produk'] = $request->jenis_produk;
		$data['harga'] = $request->harga;
		$data['stok'] = $request->stok;
		$data['status'] = $request->status;
		
		Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil ditambahkan!');
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
        $produk = Produk::with('umkm')->findOrFail($id);
        return view('produk.edit', compact('produk')); // Perbaiki: 'produk.edit' bukan 'admin.produk.edit'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $produk_id = $id;
        $produk = Produk::findOrFail($produk_id);

        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->desksripsi;
        $produk->jenis_produk = $request->jenis_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->status = $request->status;

        $produk->save();
        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil dihapus!');
    }
}