<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['kategori'];
        $searchableColumns = ['nama_usaha', 'kategori', 'pemilik.nama'];

        $umkm = Umkm::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->with(['pemilik', 'media'])
            ->orderBy('nama_usaha')
            ->paginate(10)
            ->withQueryString();

        return view('pages.guest.umkm.index', compact('umkm'));
    }

    public function create()
    {
        $warga = Warga::all();
        return view('pages.guest.umkm.create', compact('warga'));
    }

    public function store(Request $request): RedirectResponse
    {
//         if ($file->isValid()) {
//     $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
    
//     // Compress image jika file adalah gambar
//     if (Str::startsWith($file->getMimeType(), 'image/')) {
//         $image = Image::make($file);
//         $image->resize(800, 800, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         });
//         $image->save(storage_path('app/public/media/' . $fileName), 80); // 80% quality
//     } else {
//         $file->storeAs('media', $fileName, 'public');
//     }
    
//     // ... rest of the code
// }
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kategori' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048'
        ]);

        try {
            $umkm = Umkm::create($validated);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        
                        // SIMPAN KE DISK PUBLIC, FOLDER MEDIA
                        $file->storeAs('media', $fileName, 'public');
                        
                        Media::create([
                            'ref_table' => 'umkm',
                            'ref_id' => $umkm->umkm_id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $file->getClientOriginalName(),
                            'sort_order' => 0
                        ]);
                    }
                }
            }

            return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Umkm $umkm)
    {
        $umkm->load('pemilik', 'produk', 'media');
        return view('pages.guest.umkm.show', compact('umkm'));
    }

    public function edit(Umkm $umkm)
    {
        $warga = Warga::all();
        // Load media agar bisa ditampilkan di form edit
        $umkm->load('media'); 
        return view('pages.guest.umkm.edit', compact('umkm', 'warga'));
    }

    public function update(Request $request, Umkm $umkm): RedirectResponse
    {
//         if ($file->isValid()) {
//     $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
    
//     // Compress image jika file adalah gambar
//     if (Str::startsWith($file->getMimeType(), 'image/')) {
//         $image = Image::make($file);
//         $image->resize(800, 800, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         });
//         $image->save(storage_path('app/public/media/' . $fileName), 80); // 80% quality
//     } else {
//         $file->storeAs('media', $fileName, 'public');
//     }
    
//     // ... rest of the code
// }

        
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kategori' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048'
        ]);

        try {
            $umkm->update($validated);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        
                        // SIMPAN KE DISK PUBLIC
                        $file->storeAs('media', $fileName, 'public');
                        
                        Media::create([
                            'ref_table' => 'umkm',
                            'ref_id' => $umkm->umkm_id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $file->getClientOriginalName(),
                            'sort_order' => 0
                        ]);
                    }
                }
            }

            return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil diupdate.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Umkm $umkm): RedirectResponse
    {
        try {
            $mediaFiles = Media::where('ref_table', 'umkm')->where('ref_id', $umkm->umkm_id)->get();

            foreach ($mediaFiles as $media) {
                // HAPUS DARI DISK PUBLIC
                if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                    Storage::disk('public')->delete('media/' . $media->file_name);
                }
                $media->delete();
            }
            
            $umkm->delete();
            return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->route('umkm.index')->with('error', 'Gagal menghapus UMKM: ' . $e->getMessage());
        }
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
            return back()->with('success', 'File berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus file: ' . $e->getMessage());
        }
    }
}