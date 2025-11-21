<?php
namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UmkmController extends Controller
{
     public function index(Request $request) // Tambahkan parameter Request
    {
        // Daftar kolom yang bisa difilter sesuai name pada form
        $filterableColumns = ['kategori'];
        
        
        // Daftar kolom yang bisa dicari saat searching
        $searchableColumns = ['nama_usaha', 'kategori', 'pemilik.nama']; // Tambahkan ini

        // Gunakan scope filter untuk memproses query
        $umkm = Umkm::filter($request, $filterableColumns)
        ->search($request, $searchableColumns) // Tambahkan ini
                    ->with('pemilik') // Eager load relasi pemilik
                    ->orderBy('nama_usaha')
                    ->paginate(10)
                    ->withQueryString(); // Tambahkan ini untuk mempertahankan parameter filter

        return view('pages.guest.umkm.index', compact('umkm'));
    }

    public function create()
    {
        $warga = Warga::all();
        return view('pages.guest.umkm.create', compact('warga'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kategori' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Umkm::create($validated);

        return redirect()->route('umkm.index')
            ->with('success', 'Data UMKM berhasil ditambahkan.');
    }

    public function show(Umkm $umkm)
    {
        $umkm->load('pemilik', 'produk');
        return view('pages.guest.umkm.show', compact('umkm'));
    }

    public function edit(Umkm $umkm)
    {
        $warga = Warga::all();
        return view('pages.guest.umkm.edit', compact('umkm', 'warga'));
    }

    public function update(Request $request, Umkm $umkm): RedirectResponse
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kategori' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $umkm->update($validated);

        return redirect()->route('umkm.index')
            ->with('success', 'Data UMKM berhasil diupdate.');
    }

    public function destroy(Umkm $umkm): RedirectResponse
    {
        $umkm->delete();

        return redirect()->route('umkm.index')
            ->with('success', 'Data UMKM berhasil dihapus.');
    }
}