<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProdukController extends Controller
{
   
      public function index(Request $request) // Tambahkan parameter Request
    {
        // Daftar kolom yang bisa difilter sesuai name pada form
        $filterableColumns = ['jenis_produk'];
        
        
        // Daftar kolom yang bisa dicari saat searching
        $searchableColumns = ['nama_produk', 'jenis_produk', 'stok']; // Tambahkan ini
        
        // Gunakan scope filter untuk memproses query
        $dataProduk = Produk::filter($request, $filterableColumns)
             ->search($request, $searchableColumns) // Tambahkan ini
                        ->with('umkm') // Eager load relasi umkm
                        ->orderBy('nama_produk')
                        ->paginate(10)
                        ->withQueryString(); // Tambahkan ini untuk mempertahankan parameter filter

        return view('pages.guest.produk.index', compact('dataProduk'));
    }

    public function create()
    {
        $umkm = Umkm::with('pemilik')->get();
        return view('pages.guest.produk.create', compact('umkm'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:100',
            'jenis_produk' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        Produk::create($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('umkm.pemilik');
        return view('pages.guest.produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $umkm = Umkm::with('pemilik')->get();
        return view('pages.guest.produk.edit', compact('produk', 'umkm'));
    }

    public function update(Request $request, Produk $produk): RedirectResponse
    {
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:100',
            'jenis_produk' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $produk->update($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}