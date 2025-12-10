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
        $filterableColumns = ['jenis_kelamin', 'role']; // TAMBAHKAN 'role'
        $searchableColumns = ['nama', 'agama', 'pekerjaan', 'email', 'no_ktp'];
        
        $dataWarga = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->withCount('media') // TAMBAHKAN INI untuk menghitung jumlah file
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
            'role' => 'required|in:admin,warga,user', // TAMBAHKAN INI
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048' // TAMBAHKAN INI
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
                'role' => $request->role,
            ]);

            // UPLOAD MULTIPLE FILE
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '_' . Str::slug($file->getClientOriginalName());
                        
                        $file->storeAs('media', $fileName, 'public');
                        
                        Media::create([
                            'ref_table' => 'warga',
                            'ref_id' => $warga->warga_id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $file->getClientOriginalName(),
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

    public function show(Warga $warga)
    {
        $warga->load('media');
        return view('pages.guest.warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        $warga->load('media');
        return view('pages.guest.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'no_ktp' => 'required|max:20|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'nullable|email',
            'role' => 'required|in:admin,warga,user', // TAMBAHKAN INI
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048' // TAMBAHKAN INI
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
                'role' => $request->role,
            ]);

            // UPLOAD FILE BARU
            if ($request->hasFile('files')) {
                $existingFilesCount = Media::where('ref_table', 'warga')
                    ->where('ref_id', $warga->warga_id)
                    ->count();
                
                foreach ($request->file('files') as $index => $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '_' . Str::slug($file->getClientOriginalName());
                        
                        $file->storeAs('media', $fileName, 'public');
                        
                        Media::create([
                            'ref_table' => 'warga',
                            'ref_id' => $warga->warga_id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $file->getClientOriginalName(),
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

    public function destroy(Warga $warga)
    {
        try {
            // HAPUS FILE MEDIA TERLEBIH DAHULU
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

    // METHOD UNTUK HAPUS FILE SATU PER SATU
    public function deleteMedia($mediaId)
    {
        try {
            $media = Media::findOrFail($mediaId);
            
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