<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Warga;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    public function index(Request $request) 
    {
        $dataPesanan = Pesanan::query()
            ->when($request->status, function($q) use ($request) {
                return $q->where('status', $request->status);
            })
            // ✅ PERBAIKAN: Hapus 'produk' dari sini karena relasinya sudah dihapus
            ->with(['warga', 'umkm']) 
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.guest.pesanan.index', compact('dataPesanan'));
    }

    public function create()
    {
        $warga = Warga::all(); 
        $umkm  = Umkm::all(); 
        
        // Hapus $produk karena input pesanan sekarang manual total harganya (berdasarkan struktur DB baru)
        return view('pages.guest.pesanan.create', compact('warga', 'umkm'));
    }

    public function store(Request $request): RedirectResponse
    {
        // ✅ Validasi Sesuai Kolom Baru
        $validatedData = $request->validate([
            'nomor_pesanan' => 'required|string|unique:pesanan,nomor_pesanan',
            'warga_id'      => 'required|exists:warga,warga_id',
            'umkm_id'       => 'nullable|exists:umkm,umkm_id',
            'total'         => 'required|numeric|min:0', // Kolom 'total', bukan 'total_harga'
            'status'        => 'required|in:pending,processing,completed,cancelled', // Sesuaikan opsi enum/select
            'alamat_kirim'  => 'required|string',
            'rt'            => 'required|string|max:5',
            'rw'            => 'required|string|max:5',
            'metode_bayar'  => 'required|string', // Kolom 'metode_bayar'
            'bukti_bayar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Kolom 'bukti_bayar'
        ]);

        // Handle Upload
        if ($request->hasFile('bukti_bayar')) {
            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
            $validatedData['bukti_bayar'] = $path;
        }

        Pesanan::create($validatedData);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function edit(Pesanan $pesanan)
    {
        // ✅ Perbaiki logika Edit
        $warga = Warga::all();
        $umkm  = Umkm::all();

        return view('pages.guest.pesanan.edit', compact('pesanan', 'warga', 'umkm'));
    }

    public function update(Request $request, Pesanan $pesanan): RedirectResponse
    {
        // ✅ Perbaiki Validasi Update (Sesuaikan nama kolom baru)
        $validated = $request->validate([
            'warga_id'      => 'required|exists:warga,warga_id',
            'umkm_id'       => 'nullable|exists:umkm,umkm_id',
            'total'         => 'required|numeric|min:0', // Ganti total_harga jadi total
            'status'        => 'required',
            'alamat_kirim'  => 'required|string',
            'rt'            => 'required|string',
            'rw'            => 'required|string',
            'metode_bayar'  => 'required|string', // Ganti metode_pembayaran jadi metode_bayar
            'bukti_bayar'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Logic Ganti File
        if ($request->hasFile('bukti_bayar')) {
            // Hapus file lama (Gunakan nama kolom baru)
            if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
                Storage::disk('public')->delete($pesanan->bukti_bayar);
            }

            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
            $validated['bukti_bayar'] = $path;
        }

        $pesanan->update($validated);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate.');
    }

    public function destroy(Pesanan $pesanan): RedirectResponse
    {
        if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
            Storage::disk('public')->delete($pesanan->bukti_bayar);
        }
        
        $pesanan->delete();
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
    public function show($id)
{
    // 1. Cari pesanan berdasarkan pesanan_id
    // Kita load relasi 'warga', 'produk', dan 'umkm' agar data tersedia di view
    $pesanan = \App\Models\Pesanan::with(['warga', 'umkm'])
        ->where('pesanan_id', $id)
        ->firstOrFail();

    // 2. Tampilkan view detail
    // Sesuaikan path view dengan struktur folder Anda
    return view('pages.guest.pesanan.show', compact('pesanan'));
}
}