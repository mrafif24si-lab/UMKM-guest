<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    public function index(Request $request) 
    
{
    $filterableColumns = ['status', 'metode_bayar'];
    $searchableColumns = ['pesanan_id', 'alamat_kirim']; // Ubah dari 'nomor_pesanan' ke 'pesanan_id'
    
    $dataPesanan = Pesanan::filter($request, $filterableColumns)
         ->search($request, $searchableColumns)
         ->with(['warga'])
         ->orderBy('created_at', 'desc')
         ->paginate(10)
         ->withQueryString();

    return view('pages.guest.pesanan.index', compact('dataPesanan'));
}
    public function create()
    {
        $warga = Warga::all();
        return view('pages.guest.pesanan.create', compact('warga'));
    }

    public function store(Request $request): RedirectResponse
    {
    $validated = $request->validate([
        'warga_id' => 'required|exists:warga,warga_id',
        'nomor_pesanan' => 'required|string|max:50|unique:pesanan,nomor_pesanan', // PASTIKAN ini yang divalidasi
        'total' => 'required|numeric|min:0',
        'status' => 'required|in:pending,proses,dikirim,selesai,dibatalkan',
        'alamat_kirim' => 'required|string|max:255',
        'rt' => 'required|string|max:3',
        'rw' => 'required|string|max:3',
        'metode_bayar' => 'required|string|max:50',
        'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // JANGAN validasi 'pesanan_id' karena itu auto-increment dari database
    // atau jika Anda ingin mengisinya, harus ada di form

    $pesanan = Pesanan::create($validated);

    // Upload bukti bayar
    if ($request->hasFile('bukti_bayar')) {
        $file = $request->file('bukti_bayar');
        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs('media', $fileName, 'public');
        Media::create([
            'ref_table' => 'pesanan',
            'ref_id' => $pesanan->pesanan_id, // pakai PK yang di-generate
            'file_name' => $fileName,
            'mime_type' => $file->getMimeType(),
            'caption' => 'Bukti Bayar ' . $pesanan->nomor_pesanan,
            'sort_order' => 0
        ]);
    }

    return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan.');
}
    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['warga', 'media']);
        return view('pages.guest.pesanan.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        $warga = Warga::all();
        $pesanan->load('media');
        return view('pages.guest.pesanan.edit', compact('pesanan', 'warga'));
    }

    public function update(Request $request, Pesanan $pesanan): RedirectResponse
   {
    $validated = $request->validate([
        'warga_id' => 'required|exists:warga,warga_id',
        'nomor_pesanan' => 'required|string|max:50|unique:pesanan,nomor_pesanan,' . $pesanan->pesanan_id . ',pesanan_id',
        'total' => 'required|numeric|min:0',
        'status' => 'required|in:pending,proses,dikirim,selesai,dibatalkan',
        'alamat_kirim' => 'required|string|max:255',
        'rt' => 'required|string|max:3',
        'rw' => 'required|string|max:3',
        'metode_bayar' => 'required|string|max:50',
        'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $pesanan->update($validated);

    // Upload bukti bayar baru
    if ($request->hasFile('bukti_bayar')) {
        $file = $request->file('bukti_bayar');
        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs('media', $fileName, 'public');
        Media::create([
            'ref_table' => 'pesanan',
            'ref_id' => $pesanan->pesanan_id,
            'file_name' => $fileName,
            'mime_type' => $file->getMimeType(),
            'caption' => 'Bukti Bayar ' . $pesanan->nomor_pesanan,
            'sort_order' => 0
        ]);
    }

    return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate.');
}
    public function destroy(Pesanan $pesanan): RedirectResponse
    {
        // Hapus media
        $mediaFiles = Media::where('ref_table', 'pesanan')->where('ref_id', $pesanan->pesanan_id)->get();
        foreach ($mediaFiles as $media) {
            if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                Storage::disk('public')->delete('media/' . $media->file_name);
            }
            $media->delete();
        }
        
        $pesanan->delete();
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function deleteMedia($mediaId): RedirectResponse
    {
        try {
            $media = Media::findOrFail($mediaId);
            
            if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                Storage::disk('public')->delete('media/' . $media->file_name);
            }
            
            $media->delete();
            return back()->with('success', 'Bukti pembayaran berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus bukti pembayaran: ' . $e->getMessage());
        }
    }
}