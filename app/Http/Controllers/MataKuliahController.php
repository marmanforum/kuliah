<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::with(['mahasiswa', 'prodi'])->get();

        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::orderBy('nama_mahasiswa')->get();
        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('mata_kuliah.create', compact('mahasiswa', 'prodi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mata_kuliah' => ['required', 'string', 'max:150'],
            'sks' => ['required', 'integer', 'min:1', 'max:24'],
            'mahasiswa_ids' => ['required', 'array', 'min:1'],
            'mahasiswa_ids.*' => ['exists:mahasiswa,id'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
        ]);

        $mataKuliah = MataKuliah::create([
            'nama_mata_kuliah' => $validated['nama_mata_kuliah'],
            'sks' => $validated['sks'],
            'prodi_id' => $validated['prodi_id'] ?? null,
        ]);

        $mataKuliah->mahasiswa()->sync($validated['mahasiswa_ids']);

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(MataKuliah $mataKuliah)
    {
        $mataKuliah->load(['mahasiswa', 'prodi']);

        return view('mata_kuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah)
    {
        $mahasiswa = Mahasiswa::orderBy('nama_mahasiswa')->get();
        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('mata_kuliah.edit', compact(
            'mataKuliah',
            'mahasiswa',
            'prodi'
        ));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $validated = $request->validate([
            'nama_mata_kuliah' => ['required', 'string', 'max:150'],
            'sks' => ['required', 'integer', 'min:1', 'max:24'],
            'mahasiswa_ids' => ['required', 'array', 'min:1'],
            'mahasiswa_ids.*' => ['exists:mahasiswa,id'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
        ]);

        $mataKuliah->update([
            'nama_mata_kuliah' => $validated['nama_mata_kuliah'],
            'sks' => $validated['sks'],
            'prodi_id' => $validated['prodi_id'] ?? null,
        ]);

        $mataKuliah->mahasiswa()->sync($validated['mahasiswa_ids']);

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->mahasiswa()->detach();
        $mataKuliah->delete();

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}