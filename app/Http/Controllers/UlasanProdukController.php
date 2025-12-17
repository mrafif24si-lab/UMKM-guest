<?php

namespace App\Http\Controllers;

use App\Models\UlasanProduk;
use App\Models\Produk;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class UlasanProdukController extends Controller
{
    public function index(Request $request)
    {
        // Query utama dengan eager loading
        $query = UlasanProduk::query()
            ->with(['produk', 'warga'])
            ->orderBy('created_at', 'desc');

        // 1. SEARCH FUNCTIONALITY
        if ($request->filled('search')) {
            $search = $request->input('search');
            
            $query->where(function($q) use ($search) {
                $q->where('rating', 'LIKE', "%{$search}%")
                  ->orWhere('komentar', 'LIKE', "%{$search}%")
                  
                  // Search melalui relasi produk
                  ->orWhereHas('produk', function($q2) use ($search) {
                      $q2->where('nama_produk', 'LIKE', "%{$search}%")
                         ->orWhere('jenis_produk', 'LIKE', "%{$search}%");
                  })
                  
                  // Search melalui relasi warga
                  ->orWhereHas('warga', function($q2) use ($search) {
                      $q2->where('nama', 'LIKE', "%{$search}%")
                         ->orWhere('email', 'LIKE', "%{$search}%");
                  });
            });
        }

        // 2. FILTER RATING
        if ($request->filled('rating')) {
            $query->where('rating', $request->input('rating'));
        }

        // 3. FILTER BERDASARKAN PRODUK
        if ($request->filled('produk_id')) {
            $query->where('produk_id', $request->input('produk_id'));
        }

        // 4. FILTER BERDASARKAN WARGA
        if ($request->filled('warga_id')) {
            $query->where('warga_id', $request->input('warga_id'));
        }

        // 5. FILTER TANGGAL
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

        // 6. FILTER RENTANG TANGGAL
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // 7. SORTING
        if ($request->filled('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortDir = $request->input('sort_dir', 'asc');
            
            $allowedSort = ['created_at', 'updated_at', 'rating'];
            
            if (in_array($sortBy, $allowedSort)) {
                $query->orderBy($sortBy, $sortDir);
            }
        }

        // 8. PAGINATION dengan 12 item per halaman
        $ulasan = $query->paginate(12)->withQueryString();

        // 9. SUMMARY STATISTICS
        $summary = [
            'total_ulasan' => $ulasan->total(),
            'avg_rating' => round($ulasan->avg('rating'), 1),
            'rating_1' => $ulasan->where('rating', 1)->count(),
            'rating_2' => $ulasan->where('rating', 2)->count(),
            'rating_3' => $ulasan->where('rating', 3)->count(),
            'rating_4' => $ulasan->where('rating', 4)->count(),
            'rating_5' => $ulasan->where('rating', 5)->count(),
            'current_page_count' => $ulasan->count()
        ];

        // 10. DATA UNTUK FILTER DROPDOWN
        $produk = Produk::orderBy('nama_produk')->get();
        $warga = Warga::orderBy('nama')->get();

        return view('pages.guest.ulasan-produk.index', 
            compact('ulasan', 'produk', 'warga', 'summary'));
    }

    public function create()
    {
        $produk = Produk::orderBy('nama_produk')->get();
        $warga = Warga::orderBy('nama')->get();

        return view('pages.guest.ulasan-produk.create', compact('produk', 'warga'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        // Check if warga already reviewed this product
        $existingReview = UlasanProduk::where('produk_id', $validatedData['produk_id'])
            ->where('warga_id', $validatedData['warga_id'])
            ->first();

        if ($existingReview) {
            return back()->withErrors([
                'produk_id' => 'Warga ini sudah memberikan ulasan untuk produk ini.'
            ])->withInput();
        }

        // Create ulasan produk
        UlasanProduk::create($validatedData);

        return redirect()->route('ulasan-produk.index')
                        ->with('success', 'Ulasan produk berhasil ditambahkan!');
    }

    public function edit(UlasanProduk $ulasanProduk)
    {
        $produk = Produk::orderBy('nama_produk')->get();
        $warga = Warga::orderBy('nama')->get();

        return view('pages.guest.ulasan-produk.edit', 
            compact('ulasanProduk', 'produk', 'warga'));
    }

    public function update(Request $request, UlasanProduk $ulasanProduk): RedirectResponse
    {
        $validatedData = $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        // Check if another review exists for the same product and warga (excluding current)
        $existingReview = UlasanProduk::where('produk_id', $validatedData['produk_id'])
            ->where('warga_id', $validatedData['warga_id'])
            ->where('ulasan_id', '!=', $ulasanProduk->ulasan_id)
            ->first();

        if ($existingReview) {
            return back()->withErrors([
                'produk_id' => 'Warga ini sudah memberikan ulasan untuk produk ini.'
            ])->withInput();
        }

        // Update ulasan produk
        $ulasanProduk->update($validatedData);

        return redirect()->route('ulasan-produk.index')
                        ->with('success', 'Ulasan produk berhasil diperbarui!');
    }

    public function destroy(UlasanProduk $ulasanProduk): RedirectResponse
    {
        $ulasanProduk->delete();

        return redirect()->route('ulasan-produk.index')
                        ->with('success', 'Ulasan produk berhasil dihapus.');
    }

    public function show(UlasanProduk $ulasanProduk)
    {
        $ulasanProduk->load(['produk', 'warga']);
        
        return view('pages.guest.ulasan-produk.show', compact('ulasanProduk'));
    }

    // Get summary statistics (API endpoint)
    public function getSummary(Request $request)
    {
        $query = UlasanProduk::query();
        
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

    // Get product details for rating
    public function getProductDetails($id)
    {
        $product = Produk::with('umkm')->find($id);
        
        if ($product) {
            return response()->json([
                'nama_produk' => $product->nama_produk,
                'jenis_produk' => $product->jenis_produk,
                'harga' => $product->harga,
                'harga_formatted' => 'Rp ' . number_format($product->harga, 0, ',', '.'),
                'umkm' => $product->umkm->nama_usaha ?? '-',
                'avg_rating' => $product->ulasan()->avg('rating') ?? 0,
                'total_ulasan' => $product->ulasan()->count()
            ]);
        }
        
        return response()->json(['error' => 'Produk tidak ditemukan'], 404);
    }
}