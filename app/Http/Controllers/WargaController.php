<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WargaController extends Controller
{
    
    public function index(Request $request)

    
    {
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['nama', 'agama', 'pekerjaan', 'email', 'no_ktp'];
        
        // TAMBAHKAN ->with('media') dan avatar
        $dataWarga = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->with(['media', 'avatar'])
            ->withCount('media')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('pages.guest.warga.index', compact('dataWarga'));
    }

    public function create()
    {
        return view('pages.guest.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga|max:20',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'nullable|email',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048'
        ]);

        try {
            $warga = Warga::create([
                'no_ktp' => $request->no_ktp,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'telp' => $request->telp,
                'email' => $request->email,
            ]);

            // UPLOAD MULTIPLE FILE - TAMBAHKAN LOGIC SAMA DENGAN USER
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    if ($file->isValid()) {
                        // PERBAIKI NAMA FILE DENGAN EXTENSION YANG BENAR
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $fileName = time() . '_' . uniqid() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;
                        
                        $file->storeAs('media', $fileName, 'public');
                        
                        Media::create([
                            'ref_table' => 'warga',
                            'ref_id' => $warga->warga_id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $originalName,
                            'sort_order' => $index
                        ]);
                    }
                }
            }

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        // TAMBAHKAN load media
        $warga = Warga::with('media')->findOrFail($id);
        return view('pages.guest.warga.show', compact('warga'));
    }

    public function edit($id)
    {
        // TAMBAHKAN load media
        $warga = Warga::with('media')->findOrFail($id);
        return view('pages.guest.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);
        
        $request->validate([
            'no_ktp' => 'required|max:20|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'nullable|email',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048'
        ]);

        try {
            $warga->update([
                'no_ktp' => $request->no_ktp,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'telp' => $request->telp,
                'email' => $request->email,
            ]);

            // UPLOAD FILE BARU - TAMBAHKAN LOGIC SAMA DENGAN USER
            if ($request->hasFile('files')) {
                $existingFilesCount = Media::where('ref_table', 'warga')
                    ->where('ref_id', $warga->warga_id)
                    ->count();
                
                foreach ($request->file('files') as $index => $file) {
                    if ($file->isValid()) {
                        // PERBAIKI NAMA FILE DENGAN EXTENSION YANG BENAR
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $fileName = time() . '_' . uniqid() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;
                        
                        $file->storeAs('media', $fileName, 'public');
                        
                        Media::create([
                            'ref_table' => 'warga',
                            'ref_id' => $warga->warga_id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $originalName,
                            'sort_order' => $existingFilesCount + $index
                        ]);
                    }
                }
            }

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $warga = Warga::findOrFail($id);
            
            // HAPUS FILE MEDIA TERLEBIH DAHULU - SAMA DENGAN USER
            $mediaFiles = Media::where('ref_table', 'warga')
                ->where('ref_id', $warga->warga_id)
                ->get();

            foreach ($mediaFiles as $media) {
                if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                    Storage::disk('public')->delete('media/' . $media->file_name);
                }
                $media->delete();
            }
            
            $warga->delete();

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Gagal menghapus data warga: ' . $e->getMessage());
        }
    }

    // METHOD UNTUK HAPUS FILE SATU PER SATU - SAMA DENGAN USER
    // public function deleteMedia($mediaId)
    // {
    //     try {
    //         $media = Media::findOrFail($mediaId);
            
    //         if (Storage::disk('public')->exists('media/' . $media->file_name)) {
    //             Storage::disk('public')->delete('media/' . $media->file_name);
    //         }
            
    //         $media->delete();
    //         return back()->with('success', 'File berhasil dihapus.');

    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Gagal menghapus file: ' . $e->getMessage());
    //     }
    // }
        public function deleteMedia($mediaId)
    {
        try {
            // Cari media berdasarkan ID
            $media = Media::findOrFail($mediaId);
            
            // Verifikasi bahwa media ini milik warga
            if (!$media->warga_id) {
                return back()->with('error', 'File tidak ditemukan atau tidak memiliki akses.');
            }
            
            // Hapus file dari storage
            if (Storage::exists('media/' . $media->file_name)) {
                Storage::delete('media/' . $media->file_name);
            }
            
            // Hapus record dari database
            $media->delete();
            
            return back()->with('success', 'File berhasil dihapus.');
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'File tidak ditemukan.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus file: ' . $e->getMessage());
        }
    }
}