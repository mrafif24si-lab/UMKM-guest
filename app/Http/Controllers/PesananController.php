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
    // Validasi sesuai dengan form
    $validatedData = $request->validate([
        'nomor_pesanan' => 'required|string|unique:pesanan,nomor_pesanan',
        'warga_id' => 'required|exists:warga,warga_id',
        'umkm_id' => 'nullable|exists:umkm,umkm_id',
        'total' => 'required|numeric|min:1000',
        'status' => 'required|in:pending,proses,dikirim,selesai,dibatalkan',
        'alamat_kirim' => 'required|string|max:500',
        'rt' => 'required|string|max:3',
        'rw' => 'required|string|max:3',
        'metode_bayar' => 'required|in:Transfer Bank,Tunai,E-Wallet,QRIS',
        'bukti_bayar' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:2048',
        'catatan' => 'nullable|string|max:500',
    ]);

    // Handle file upload
    if ($request->hasFile('bukti_bayar')) {
        $filename = 'bukti-bayar-' . time() . '-' . $request->file('bukti_bayar')->getClientOriginalName();
        $path = $request->file('bukti_bayar')->storeAs('bukti_bayar', $filename, 'public');
        $validatedData['bukti_bayar'] = $path;
    }

    // Create pesanan
    Pesanan::create($validatedData);

    return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
}

    public function edit(Pesanan $pesanan)
    {
        // LOAD DATA WARGA DAN UMKM UNTUK DROPDOWN
        $warga = Warga::orderBy('nama')->get();
        $umkm = Umkm::orderBy('nama_usaha')->get();

        return view('pages.guest.pesanan.edit', compact('pesanan', 'warga', 'umkm'));
    }

    public function update(Request $request, Pesanan $pesanan): RedirectResponse
    {
        // VALIDASI SESUAI STATUS DI FORM ANDA
        $validated = $request->validate([
            'nomor_pesanan' => 'required|string|unique:pesanan,nomor_pesanan,' . $pesanan->pesanan_id . ',pesanan_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'total' => 'required|numeric|min:1000',
            'status' => 'required|in:pending,proses,dikirim,selesai,dibatalkan', // SESUAI FORM
            'alamat_kirim' => 'required|string|max:500',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'metode_bayar' => 'required|in:Transfer Bank,Tunai,E-Wallet,QRIS',
            'bukti_bayar' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ]);

        // HANDLE FILE UPLOAD
        if ($request->hasFile('bukti_bayar')) {
            // Hapus file lama jika ada
            if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
                Storage::disk('public')->delete($pesanan->bukti_bayar);
            }

            // Upload file baru
            $filename = 'bukti-bayar-' . $pesanan->pesanan_id . '-' . time() . '.' . $request->file('bukti_bayar')->getClientOriginalExtension();
            $path = $request->file('bukti_bayar')->storeAs('bukti_bayar', $filename, 'public');
            $validated['bukti_bayar'] = $path;
        }

        $pesanan->update($validated);

        return redirect()->route('pesanan.show', $pesanan->pesanan_id)
                        ->with('success', 'Pesanan berhasil diupdate!');
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
        // LOAD HANYA WARGA SAJA, TIDAK PERLU MEDIA
        $pesanan = Pesanan::with(['warga'])
            ->where('pesanan_id', $id)
            ->firstOrFail();

        return view('pages.guest.pesanan.show', compact('pesanan'));
    }
}