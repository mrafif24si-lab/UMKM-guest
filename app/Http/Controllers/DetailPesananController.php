<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DetailPesananController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['pesanan_id'];
        $searchableColumns = [
            'qty', 
            'pesanan.nomor_pesanan',
            'produk.nama_produk'
        ];

        $detailPesanan = DetailPesanan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->with(['pesanan', 'produk.umkm'])
            ->orderBy('detail_id', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Get all pesanan for filter dropdown
        $pesananList = Pesanan::orderBy('nomor_pesanan')->get();

        return view('pages.guest.detail-pesanan.index', compact('detailPesanan', 'pesananList'));
    }

    public function create()
    {
        $pesanan = Pesanan::orderBy('nomor_pesanan')->get();
        $produk = Produk::with('umkm')->orderBy('nama_produk')->get();
        
        return view('pages.guest.detail-pesanan.create', compact('pesanan', 'produk'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pesanan_id' => 'required|exists:pesanan,pesanan_id',
            'produk_id' => 'required|exists:produk,produk_id',
            'qty' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Check if produk already exists in the pesanan
            $existingDetail = DetailPesanan::where('pesanan_id', $validated['pesanan_id'])
                ->where('produk_id', $validated['produk_id'])
                ->first();

            if ($existingDetail) {
                return redirect()->back()
                    ->with('error', 'Produk ini sudah ada dalam pesanan. Silakan edit jumlah yang ada.')
                    ->withInput();
            }

            // Calculate subtotal
            $subtotal = $validated['qty'] * $validated['harga_satuan'];
            $validated['subtotal'] = $subtotal;

            $detailPesanan = DetailPesanan::create($validated);

            // Update total pesanan
            $this->updateTotalPesanan($detailPesanan->pesanan_id);

            DB::commit();

            return redirect()->route('detail-pesanan.index')
                ->with('success', 'Detail pesanan berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(DetailPesanan $detailPesanan)
    {
        $detailPesanan->load(['pesanan.warga', 'produk.umkm.pemilik', 'produk.media']);
        return view('pages.guest.detail-pesanan.show', compact('detailPesanan'));
    }

    public function edit(DetailPesanan $detailPesanan)
    {
        $pesanan = Pesanan::orderBy('nomor_pesanan')->get();
        $produk = Produk::with('umkm')->orderBy('nama_produk')->get();
        
        return view('pages.guest.detail-pesanan.edit', compact('detailPesanan', 'pesanan', 'produk'));
    }

    public function update(Request $request, DetailPesanan $detailPesanan): RedirectResponse
    {
        $validated = $request->validate([
            'pesanan_id' => 'required|exists:pesanan,pesanan_id',
            'produk_id' => 'required|exists:produk,produk_id',
            'qty' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Check for duplicate produk in same pesanan (excluding current)
            if ($detailPesanan->produk_id != $validated['produk_id'] || $detailPesanan->pesanan_id != $validated['pesanan_id']) {
                $existingDetail = DetailPesanan::where('pesanan_id', $validated['pesanan_id'])
                    ->where('produk_id', $validated['produk_id'])
                    ->where('detail_id', '!=', $detailPesanan->detail_id)
                    ->first();

                if ($existingDetail) {
                    return redirect()->back()
                        ->with('error', 'Produk ini sudah ada dalam pesanan. Silakan edit jumlah yang ada.')
                        ->withInput();
                }
            }

            // Calculate subtotal
            $subtotal = $validated['qty'] * $validated['harga_satuan'];
            $validated['subtotal'] = $subtotal;

            $oldPesananId = $detailPesanan->pesanan_id;
            
            $detailPesanan->update($validated);

            // Update total for old pesanan (if changed)
            if ($oldPesananId != $validated['pesanan_id']) {
                $this->updateTotalPesanan($oldPesananId);
            }

            // Update total for new pesanan
            $this->updateTotalPesanan($validated['pesanan_id']);

            DB::commit();

            return redirect()->route('detail-pesanan.index')
                ->with('success', 'Detail pesanan berhasil diupdate.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(DetailPesanan $detailPesanan): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $pesananId = $detailPesanan->pesanan_id;
            $detailPesanan->delete();

            // Update total pesanan
            $this->updateTotalPesanan($pesananId);

            DB::commit();

            return redirect()->route('detail-pesanan.index')
                ->with('success', 'Detail pesanan berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('detail-pesanan.index')
                ->with('error', 'Gagal menghapus detail pesanan: ' . $e->getMessage());
        }
    }

    private function updateTotalPesanan($pesananId): void
    {
        $total = DetailPesanan::where('pesanan_id', $pesananId)->sum('subtotal');
        
        Pesanan::where('pesanan_id', $pesananId)->update([
            'total' => $total
        ]);
    }

    // AJAX endpoint untuk mendapatkan harga produk
    public function getHargaProduk(Request $request)
    {
        $produk = Produk::find($request->produk_id);
        
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'harga_satuan' => $produk->harga,
            'nama_produk' => $produk->nama_produk,
            'stok' => $produk->stok
        ]);
    }
}