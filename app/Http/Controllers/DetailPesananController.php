<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class DetailPesananController extends Controller
{
    public function index(Request $request)
    {
        $query = DetailPesanan::query()
            ->with(['pesanan.warga', 'produk.umkm'])
            ->orderBy('created_at', 'desc');
            
        if ($request->filled('search')) {
            $search = $request->input('search');
            
            // Gunakan scope search dari model
            $query->where(function($q) use ($search) {
                // Search di tabel detail_pesanan (qty, harga, subtotal)
                $q->where('qty', 'LIKE', "%{$search}%")
                  ->orWhere('harga_satuan', 'LIKE', "%{$search}%")
                  ->orWhere('subtotal', 'LIKE', "%{$search}%")
                  
                  // Search melalui relasi pesanan
                  ->orWhereHas('pesanan', function($q2) use ($search) {
                      $q2->where('nomor_pesanan', 'LIKE', "%{$search}%")
                         ->orWhere('alamat_kirim', 'LIKE', "%{$search}%");
                  })
                  
                  // Search melalui relasi pesanan->warga
                  ->orWhereHas('pesanan.warga', function($q2) use ($search) {
                      $q2->where('nama', 'LIKE', "%{$search}%")
                         ->orWhere('no_ktp', 'LIKE', "%{$search}%");
                  })
                  
                  // Search melalui relasi produk
                  ->orWhereHas('produk', function($q2) use ($search) {
                      $q2->where('nama_produk', 'LIKE', "%{$search}%")
                         ->orWhere('jenis_produk', 'LIKE', "%{$search}%")
                         ->orWhere('deskripsi', 'LIKE', "%{$search}%");
                  })
                  
                  // Search melalui relasi produk->umkm
                  ->orWhereHas('produk.umkm', function($q2) use ($search) {
                      $q2->where('nama_usaha', 'LIKE', "%{$search}%")
                         ->orWhere('kategori', 'LIKE', "%{$search}%")
                         ->orWhere('alamat', 'LIKE', "%{$search}%");
                  });
            });
        }

        // 2. FILTER TANGGAL
        if ($request->filled('tanggal')) {
            $now = Carbon::now();
            
            switch ($request->input('tanggal')) {
                case 'hari_ini':
                    $query->whereDate('created_at', $now->toDateString());
                    break;
                case 'minggu_ini':
                    $query->whereBetween('created_at', [
                        $now->startOfWeek()->toDateTimeString(),
                        $now->endOfWeek()->toDateTimeString()
                    ]);
                    break;
                case 'bulan_ini':
                    $query->whereBetween('created_at', [
                        $now->startOfMonth()->toDateTimeString(),
                        $now->endOfMonth()->toDateTimeString()
                    ]);
                    break;
                case 'tahun_ini':
                    $query->whereYear('created_at', $now->year);
                    break;
            }
        }

        // 3. FILTER BERDASARKAN PESANAN (opsional)
        if ($request->filled('pesanan_id')) {
            $query->where('pesanan_id', $request->input('pesanan_id'));
        }

        // 4. FILTER BERDASARKAN PRODUK (opsional)
        if ($request->filled('produk_id')) {
            $query->where('produk_id', $request->input('produk_id'));
        }

        // 5. FILTER RENTANG TANGGAL (opsional)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // 6. SORTING (opsional)
        if ($request->filled('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortDir = $request->input('sort_dir', 'asc');
            
            $allowedSort = ['created_at', 'updated_at', 'qty', 'harga_satuan', 'subtotal'];
            
            if (in_array($sortBy, $allowedSort)) {
                $query->orderBy($sortBy, $sortDir);
            }
        }

        // 7. PAGINATION dengan 12 item per halaman
        $detailPesanan = $query->paginate(12)->withQueryString();

        // 8. SUMMARY STATISTICS
        $summary = [
            'total_items' => $detailPesanan->total(),
            'total_qty' => $detailPesanan->sum('qty'),
            'total_subtotal' => $detailPesanan->sum('subtotal'),
            'avg_qty' => $detailPesanan->avg('qty'),
            'avg_subtotal' => $detailPesanan->avg('subtotal'),
            'current_page_count' => $detailPesanan->count()
        ];

        // 9. DATA UNTUK FILTER DROPDOWN
        $pesanan = Pesanan::with('warga')->orderBy('created_at', 'desc')->get();
        $produk = Produk::with('umkm')->orderBy('nama_produk')->get();

        return view('pages.guest.detail-pesanan.index', 
            compact('detailPesanan', 'pesanan', 'produk', 'summary'));
    }

    public function create()
    {
        $pesanan = Pesanan::with('warga')->orderBy('created_at', 'desc')->get();
        $produk = Produk::with('umkm')->orderBy('nama_produk')->get();

        return view('pages.guest.detail-pesanan.create', compact('pesanan', 'produk'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'pesanan_id' => 'required|exists:pesanan,pesanan_id',
            'produk_id' => 'required|exists:produk,produk_id',
            'qty' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:100',
        ]);

        // Cek stok produk menggunakan method dari model
        $produk = Produk::find($validatedData['produk_id']);
        
        // Validasi stok
        if (!$produk || $produk->stok < $validatedData['qty']) {
            return back()->withErrors([
                'qty' => 'Stok produk tidak mencukupi. Stok tersedia: ' . ($produk->stok ?? 0)
            ])->withInput();
        }

        // Calculate subtotal
        $validatedData['subtotal'] = $validatedData['qty'] * $validatedData['harga_satuan'];

        // Create detail pesanan
        $detailPesanan = DetailPesanan::create($validatedData);

        // Update stok produk menggunakan method dari model
        if ($detailPesanan) {
            $detailPesanan->updateProductStock(true); // true = detail baru
        }

        return redirect()->route('detail-pesanan.index')
                        ->with('success', 'Detail pesanan berhasil ditambahkan!');
    }

    public function edit(DetailPesanan $detailPesanan)
    {
        $pesanan = Pesanan::with('warga')->orderBy('created_at', 'desc')->get();
        $produk = Produk::with('umkm')->orderBy('nama_produk')->get();

        return view('pages.guest.detail-pesanan.edit', 
            compact('detailPesanan', 'pesanan', 'produk'));
    }

    public function update(Request $request, DetailPesanan $detailPesanan): RedirectResponse
    {
        $validatedData = $request->validate([
            'pesanan_id' => 'required|exists:pesanan,pesanan_id',
            'produk_id' => 'required|exists:produk,produk_id',
            'qty' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:100',
        ]);

        // Simpan qty lama untuk perhitungan stok
        $oldQty = $detailPesanan->qty;
        $oldProdukId = $detailPesanan->produk_id;

        // Cek stok produk jika ada perubahan
        if ($validatedData['produk_id'] != $oldProdukId || $validatedData['qty'] != $oldQty) {
            
            // Jika produk berubah, validasi stok produk baru
            if ($validatedData['produk_id'] != $oldProdukId) {
                $produkBaru = Produk::find($validatedData['produk_id']);
                if (!$produkBaru || $produkBaru->stok < $validatedData['qty']) {
                    return back()->withErrors([
                        'qty' => 'Stok produk baru tidak mencukupi. Stok tersedia: ' . ($produkBaru->stok ?? 0)
                    ])->withInput();
                }
            } else {
                // Produk sama, validasi stok dengan mempertimbangkan qty lama
                $produk = Produk::find($validatedData['produk_id']);
                $availableStock = $produk->stok + $oldQty; // Kembalikan stok lama dulu
                
                if ($availableStock < $validatedData['qty']) {
                    return back()->withErrors([
                        'qty' => 'Stok produk tidak mencukupi. Stok tersedia setelah koreksi: ' . $availableStock
                    ])->withInput();
                }
            }
        }

        // Calculate subtotal
        $validatedData['subtotal'] = $validatedData['qty'] * $validatedData['harga_satuan'];

        // Update detail pesanan
        $detailPesanan->update($validatedData);

        // Update stok produk
        if ($validatedData['produk_id'] != $oldProdukId) {
            // Jika produk berubah, restore stok produk lama dan kurangi stok produk baru
            $produkLama = Produk::find($oldProdukId);
            if ($produkLama) {
                $produkLama->increment('stok', $oldQty);
            }
            
            $produkBaru = Produk::find($validatedData['produk_id']);
            if ($produkBaru) {
                $produkBaru->decrement('stok', $validatedData['qty']);
            }
        } else {
            // Produk sama, update stok berdasarkan selisih qty
            $detailPesanan->updateProductStock(false, $oldQty); // false = bukan detail baru
        }

        return redirect()->route('detail-pesanan.index')
                        ->with('success', 'Detail pesanan berhasil diperbarui!');
    }

    public function destroy(DetailPesanan $detailPesanan): RedirectResponse
    {
        // Restore stok produk sebelum delete
        $detailPesanan->restoreProductStock();
        
        // Hapus detail pesanan
        $detailPesanan->delete();

        return redirect()->route('detail-pesanan.index')
                        ->with('success', 'Detail pesanan berhasil dihapus.');
    }

    public function show(DetailPesanan $detailPesanan)
    {
        $detailPesanan->load(['pesanan.warga', 'produk.umkm', 'produk.media']);
        
        return view('pages.guest.detail-pesanan.show', compact('detailPesanan'));
    }

    // Get product price based on product selection
    public function getProductPrice($id)
    {
        $product = Produk::find($id);
        
        if ($product) {
            return response()->json([
                'harga' => $product->harga,
                'harga_formatted' => 'Rp ' . number_format($product->harga, 0, ',', '.'),
                'stok' => $product->stok,
                'jenis_produk' => $product->jenis_produk,
                'umkm' => $product->umkm->nama_usaha ?? '-',
                'status' => $product->status
            ]);
        }
        
        return response()->json(['error' => 'Produk tidak ditemukan'], 404);
    }

    // Get summary statistics (API endpoint)
    public function getSummary(Request $request)
    {
        $query = DetailPesanan::query();
        
        // Apply filters if any
        if ($request->filled('tanggal')) {
            $query->filterByDate($request->tanggal);
        }
        
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        $summary = $query->getSummary();
        
        return response()->json([
            'success' => true,
            'data' => $summary
        ]);
    }
}