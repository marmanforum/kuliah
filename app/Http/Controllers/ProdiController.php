<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::withCount(['mahasiswa', 'mataKuliah'])->get();

        return view('prodi.index', compact('prodi'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi' => ['required', 'string', 'max:150'],
            'akreditasi' => ['required', 'in:unggul,baik,sangat baik,belum terakreditasi'],
            'foto_profil' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('prodi', 'public');
        }

        Prodi::create($validated);

        return redirect()->route('prodi.index')->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function show(Prodi $prodi)
    {
        $prodi->load(['mahasiswa', 'mataKuliah']);

        return view('prodi.show', compact('prodi'));
    }

    public function edit(Prodi $prodi)
    {
        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $validated = $request->validate([
            'nama_prodi' => ['required', 'string', 'max:150'],
            'akreditasi' => ['required', 'in:unggul,baik,sangat baik,belum terakreditasi'],
            'foto_profil' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto_profil')) {
            $oldPhoto = $prodi->foto_profil;
            $validated['foto_profil'] = $request->file('foto_profil')->store('prodi', 'public');
            $prodi->update($validated);

            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        } else {
            $prodi->update($validated);
        }

        return redirect()->route('prodi.index')->with('success', 'Program studi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        if ($prodi->foto_profil) {
            Storage::disk('public')->delete($prodi->foto_profil);
        }

        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Program studi berhasil dihapus.');
    }
}