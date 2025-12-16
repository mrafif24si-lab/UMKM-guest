<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Warga;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\User;   // Model untuk Pelanggan (User)

class PesananController extends Controller
{
 
       public function index(Request $request) 
    {
        $dataPesanan = Pesanan::query()
             ->when($request->status, function($q) use ($request) {
                 return $q->where('status', $request->status);
             })
             // Relasi disesuaikan dengan nama method di Model (warga, produk, umkm)
             ->with(['warga', 'produk', 'umkm']) 
             ->orderBy('created_at', 'desc')
             ->paginate(10)
             ->withQueryString();

        return view('pages.guest.pesanan.index', compact('dataPesanan'));
    }

    public function create()
    {
        // PERBAIKAN: Ambil semua data DULU, baru return view
        $warga  = Warga::all(); 
        $produk = Produk::all();
        $umkm   = Umkm::all(); // Tambahkan ini agar bisa pilih UMKM
        
        // Kirim semua variabel ke view
        return view('pages.guest.pesanan.create', compact('warga', 'produk', 'umkm'));
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input dari Form HTML
        $request->validate([
            'warga_id'          => 'required|exists:warga,warga_id',
            'produk_id'         => 'required|exists:produk,produk_id',
            'umkm_id'           => 'required|exists:umkm,umkm_id',
            'jumlah'            => 'required|integer|min:1',
            'total_harga'       => 'required|numeric|min:0', // Pastikan name di form="total_harga"
            'status'            => 'required|in:pending,proses,dikirim,selesai,dibatalkan',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran'  => 'nullable|image|max:2048',
            // Field tambahan (alamat) kita gabung ke catatan karena tidak ada kolom alamat di tabel pesanan
            'alamat_kirim'      => 'required|string',
            'rt'                => 'required|string',
            'rw'                => 'required|string',
        ]);

        // 2. Siapkan data untuk disimpan (Mapping)
        $data = [
            'warga_id'          => $request->warga_id,
            'produk_id'         => $request->produk_id,
            'umkm_id'           => $request->umkm_id,
            'jumlah'            => $request->jumlah,
            'total_harga'       => $request->total_harga,
            'status'            => $request->status,
            'metode_pembayaran' => $request->metode_pembayaran,
            // Menggabungkan alamat ke kolom catatan agar tersimpan
            'catatan'           => "Alamat: {$request->alamat_kirim} (RT {$request->rt}/RW {$request->rw}). " . $request->catatan,
            'no_resi'           => null, // Default kosong
        ];

        // 3. Upload File
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bukti_bayar', $fileName, 'public');
            $data['bukti_pembayaran'] = $fileName; 
        }

        Pesanan::create($data);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['pelanggan', 'produk', 'umkm']);
        return view('pages.guest.pesanan.show', compact('pesanan'));
    }

    // --- BAGIAN EDIT YANG DIPERBAIKI ---
    public function edit(Pesanan $pesanan)
    {
        $warga = Warga::all(); // Ambil data warga
    return view('pages.guest.pesanan.edit', compact('pesanan', 'warga'));
        $produk = Produk::all();
        
        // PENTING: Mendefinisikan variabel $warga agar tidak error di view 'edit.blade.php'
        // Kita ambil dari model User karena di database relasinya ke users (pelanggan_id)
    

        // Kirim $pesanan, $produk, DAN $warga ke view
        return view('pages.guest.pesanan.edit', compact('pesanan', 'produk', 'warga'));
    }

    // --- BAGIAN UPDATE YANG DIPERBAIKI ---
    public function update(Request $request, Pesanan $pesanan): RedirectResponse
    {
        
        // VALIDASI UPDATE YANG BENAR
        // Kita gunakan 'pelanggan_id', BUKAN 'warga_id'
        // Kita HAPUS validasi 'rt', 'rw', 'nomor_pesanan' karena kolom itu TIDAK ADA di tabel pesanan Anda.
        
        $validated = $request->validate([
            'pelanggan_id'      => 'required|exists:users,id', 
            'jumlah'            => 'required|integer|min:1',
            'total_harga'       => 'required|numeric|min:0',
            'status'            => 'required|in:pending,proses,dikirim,selesai,dibatalkan',
            'metode_pembayaran' => 'required|string|max:50',
            'bukti_pembayaran'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan'           => 'nullable|string',
            'no_resi'           => 'nullable|string|max:255'
        ]);

        // Logic Ganti File Bukti Bayar
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama
            if ($pesanan->bukti_pembayaran && Storage::disk('public')->exists('bukti_bayar/' . $pesanan->bukti_pembayaran)) {
                Storage::disk('public')->delete('bukti_bayar/' . $pesanan->bukti_pembayaran);
            }

            // Upload file baru
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bukti_bayar', $fileName, 'public');
            $validated['bukti_pembayaran'] = $fileName;
        }

        $pesanan->update($validated);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate.');
    }

    public function destroy(Pesanan $pesanan): RedirectResponse
    {
        if ($pesanan->bukti_pembayaran && Storage::disk('public')->exists('bukti_bayar/' . $pesanan->bukti_pembayaran)) {
            Storage::disk('public')->delete('bukti_bayar/' . $pesanan->bukti_pembayaran);
        }
        
        $pesanan->delete();
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}