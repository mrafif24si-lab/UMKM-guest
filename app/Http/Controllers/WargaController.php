<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request) // Tambahkan parameter Request
    {
        // Daftar kolom yang bisa difilter sesuai name pada form
        $filterableColumns = ['jenis_kelamin'];
        
           // Daftar kolom yang bisa dicari saat searching
        $searchableColumns = ['nama', 'agama', 'pekerjaan', 'email']; // Tambahkan ini

        // Gunakan scope filter untuk memproses query
        $dataWarga = Warga::filter($request, $filterableColumns)
         ->search($request, $searchableColumns) // Tambahkan ini
                        ->paginate(10)
                        ->withQueryString(); // Tambahkan ini untuk mempertahankan parameter filter

        return view('pages.guest.warga.index', compact('dataWarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.guest.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.guest.warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_ktp' => 'required|max:20|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'nullable|email',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}