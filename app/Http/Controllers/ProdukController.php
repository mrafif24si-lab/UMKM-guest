<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request) 
    {
        $filterableColumns = ['jenis_produk'];
        $searchableColumns = ['nama_produk', 'jenis_produk', 'stok']; 
        
        $dataProduk = Produk::filter($request, $filterableColumns)
             ->search($request, $searchableColumns) 
             ->with(['umkm', 'media']) 
             ->orderBy('nama_produk')
             ->paginate(10)
             ->withQueryString(); 

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
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $inputData = collect($validated)->except('gambar')->toArray();
        $produk = Produk::create($inputData);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('media', $fileName, 'public');
                Media::create([
                    'ref_table' => 'produk', 'ref_id' => $produk->produk_id,
                    'file_name' => $fileName, 'mime_type' => $file->getMimeType(),
                    'caption' => 'Foto ' . $produk->nama_produk, 'sort_order'=> 0
                ]);
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('umkm.pemilik', 'media');
        return view('pages.guest.produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $umkm = Umkm::with('pemilik')->get();
        $produk->load('media'); 
        return view('pages.guest.produk.edit', compact('produk', 'umkm'));
    }

    // --- BAGIAN INI YANG KITA PERBAIKI ---
    public function update(Request $request, Produk $produk): RedirectResponse
    {
        // 1. Validasi
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:100',
            'jenis_produk' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Nonaktif',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB per foto
        ]);

        // 2. Ambil data bersih (tanpa gambar)
        $inputData = collect($validated)->except('gambar')->toArray();

        // 3. Update Database
        $produk->update($inputData);

        // 4. Proses Upload Gambar (Jika ada)
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('media', $fileName, 'public');
                Media::create([
                    'ref_table' => 'produk', 'ref_id' => $produk->produk_id,
                    'file_name' => $fileName, 'mime_type' => $file->getMimeType(),
                    'caption' => 'Foto ' . $produk->nama_produk, 'sort_order'=> 0
                ]);
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        // Hapus file fisik dulu
        $mediaFiles = Media::where('ref_table', 'produk')->where('ref_id', $produk->produk_id)->get();
        foreach ($mediaFiles as $media) {
            if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                Storage::disk('public')->delete('media/' . $media->file_name);
            }
            $media->delete();
        }
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
     public function deleteMedia($mediaId): RedirectResponse
    {
        try {
            $media = Media::findOrFail($mediaId);
            
            // HAPUS DARI DISK PUBLIC
            if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                Storage::disk('public')->delete('media/' . $media->file_name);
            }
            
            $media->delete();
            return back()->with('success', 'Gambar berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }
}