<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media; // 1. TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // 2. TAMBAHKAN INI
use Illuminate\Support\Str; // 3. TAMBAHKAN INI
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image; // 4. TAMBAHKAN INI

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['huruf_awal', 'role'];
        
        $searchableColumns = ['name', 'email'];
        
        $users = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->with('media')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('pages.guest.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.guest.user.create');
    }

    public function store(Request $request)
    {
        // 7. TAMBAHKAN validasi files.*
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,warga,user',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048' // TAMBAHKAN INI
        ]);

        // 8. TAMBAHKAN try-catch block
        try {
            // 9. SIMPAN user ke variabel $user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // 10. TAMBAHKAN LOGIC UNTUK UPLOAD FILE
            // if ($request->hasFile('files')) {
            //     foreach ($request->file('files') as $index => $file) {
            //         if ($file->isValid()) {
            //             $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        
            //             // Compress image jika file adalah gambar
            //             if (Str::startsWith($file->getMimeType(), 'image/')) {
            //                 $image = Image::make($file);
            //                 $image->resize(800, 800, function ($constraint) {
            //                     $constraint->aspectRatio();
            //                     $constraint->upsize();
            //                 });
            //                 $image->save(storage_path('app/public/media/' . $fileName), 80); // 80% quality
            //             } else {
            //                 $file->storeAs('media', $fileName, 'public');
            //             }

             // SIMPAN FILE TANPA COMPRESS
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '_' . Str::slug($file->getClientOriginalName());
                        
                        // Simpan file biasa
                        $file->storeAs('media', $fileName, 'public');
                        
                        Media::create([
                            'ref_table' => 'user',
                            'ref_id' => $user->id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $file->getClientOriginalName(),
                            'sort_order' => $index
                        ]);
                    }
                }
            }

            return redirect()->route('user.index')
                ->with('success', 'User berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(User $user)
    {
        // 11. TAMBAHKAN load media dan ubah view path
        $user->load('media');
        return view('pages.guest.user.show', compact('user')); // UBAH dari 'user.show'
    }

    public function edit(User $user)
    {
        // 12. TAMBAHKAN load media
        $user->load('media');
        return view('pages.guest.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // 13. TAMBAHKAN validasi files.* dan role
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,warga,user', // TAMBAHKAN INI
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048' // TAMBAHKAN INI
        ]);

        // 14. TAMBAHKAN try-catch
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role, // TAMBAHKAN INI
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            // 15. TAMBAHKAN LOGIC UNTUK UPLOAD FILE BARU
            if ($request->hasFile('files')) {
                $existingFilesCount = Media::where('ref_table', 'user')
                    ->where('ref_id', $user->id)
                    ->count();
                
                foreach ($request->file('files') as $index => $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        
                        // Compress image jika file adalah gambar
                        // if (Str::startsWith($file->getMimeType(), 'image/')) {
                        //     $image = Image::make($file);
                        //     $image->resize(800, 800, function ($constraint) {
                        //         $constraint->aspectRatio();
                        //         $constraint->upsize();
                        //     });
                        //     $image->save(storage_path('app/public/media/' . $fileName), 80);
                        // } else {
                        //     $file->storeAs('media', $fileName, 'public');
                        // }
                        
                                 // Simpan file biasa
                        $file->storeAs('media', $fileName, 'public');

                        Media::create([
                            'ref_table' => 'user',
                            'ref_id' => $user->id,
                            'file_name' => $fileName,
                            'mime_type' => $file->getMimeType(),
                            'caption' => $file->getClientOriginalName(),
                            'sort_order' => $existingFilesCount + $index
                        ]);
                    }
                }
            }

            return redirect()->route('user.index')
                ->with('success', 'User berhasil diupdate.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(User $user)
    {
        // 16. TAMBAHKAN LOGIC UNTUK HAPUS MEDIA FILE
        try {
            // Hapus media files terlebih dahulu
            $mediaFiles = Media::where('ref_table', 'user')->where('ref_id', $user->id)->get();

            foreach ($mediaFiles as $media) {
                // HAPUS DARI DISK PUBLIC
                if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                    Storage::disk('public')->delete('media/' . $media->file_name);
                }
                $media->delete();
            }
            
            $user->delete();

            return redirect()->route('user.index')
                ->with('success', 'User berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->route('user.index')
                ->with('error', 'Gagal menghapus User: ' . $e->getMessage());
        }
    }

    // 17. TAMBAHKAN METHOD BARU INI
    public function deleteMedia($mediaId)
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