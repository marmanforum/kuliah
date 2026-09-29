<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::query()
            ->leftJoin('prodi as sort_prodi', 'mahasiswa.prodi_id', '=', 'sort_prodi.id')
            ->select('mahasiswa.*')
            ->with('prodi')
            ->orderByRaw('CASE WHEN sort_prodi.id IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_prodi.nama_prodi')
            ->orderBy('mahasiswa.nama_mahasiswa')
            ->get();

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('mahasiswa.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:30', 'unique:mahasiswa,nim'],
            'nama_mahasiswa' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat' => ['required', 'string'],
            'foto_mahasiswa' => ['nullable', 'image', 'max:2048'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
        ]);

        if ($request->hasFile('foto_mahasiswa')) {
            $validated['foto_mahasiswa'] = $request->file('foto_mahasiswa')->store('mahasiswa', 'public');
        }

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load(['prodi', 'mataKuliah']);

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'prodi'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:30', Rule::unique('mahasiswa', 'nim')->ignore($mahasiswa->id)],
            'nama_mahasiswa' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat' => ['required', 'string'],
            'foto_mahasiswa' => ['nullable', 'image', 'max:2048'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
        ]);

        if ($request->hasFile('foto_mahasiswa')) {
            $oldPhoto = $mahasiswa->foto_mahasiswa;
            $validated['foto_mahasiswa'] = $request->file('foto_mahasiswa')->store('mahasiswa', 'public');
            $mahasiswa->update($validated);

            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        } else {
            $mahasiswa->update($validated);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->foto_mahasiswa) {
            Storage::disk('public')->delete($mahasiswa->foto_mahasiswa);
        }

        $mahasiswa->mataKuliah()->detach();
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}