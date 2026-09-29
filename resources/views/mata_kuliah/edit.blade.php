@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Perbarui data</span>
        <h1 class="page-title">Edit Mata Kuliah</h1>
    </div>
    <a href="{{ route('mata_kuliah.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="form-panel">
    <form action="{{ route('mata_kuliah.update', $mataKuliah) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-field">
                <label for="nama_mata_kuliah">Nama Mata Kuliah</label>
                <input id="nama_mata_kuliah" name="nama_mata_kuliah" value="{{ old('nama_mata_kuliah', $mataKuliah->nama_mata_kuliah) }}" class="form-control @error('nama_mata_kuliah') is-invalid @enderror" required>
                @error('nama_mata_kuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-field">
                <label for="sks">SKS</label>
                <input id="sks" name="sks" type="number" min="1" max="24" value="{{ old('sks', $mataKuliah->sks) }}" class="form-control @error('sks') is-invalid @enderror" required>
                @error('sks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-field" style="grid-column: 1 / -1;">
                <label>Mahasiswa</label>
                <div class="mt-2">
                    @foreach($mahasiswa as $item)
                        <label class="d-flex align-items-center gap-2 mb-2 p-2 rounded border" style="background: #f8faff;">
                            <input type="checkbox" name="mahasiswa_ids[]" value="{{ $item->id }}" @checked(old('mahasiswa_ids') ? in_array((string) $item->id, old('mahasiswa_ids', [])) : $mataKuliah->mahasiswa->contains($item->id))>
                            <span>{{ $item->nim }} - {{ $item->nama_mahasiswa }}</span>
                        </label>
                    @endforeach
                </div>
                @error('mahasiswa_ids')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                @error('mahasiswa_ids.*')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-field">
                <label for="prodi_id">Program Studi</label>
                <select id="prodi_id" name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                    <option value="" @selected(old('prodi_id', $mataKuliah->prodi_id) == '')>Belum Mengikuti Prodi</option>
                    @foreach($prodi as $item)
                        <option value="{{ $item->id }}" @selected(old('prodi_id', $mataKuliah->prodi_id) == $item->id)>{{ $item->nama_prodi }}</option>
                    @endforeach
                </select>
                @error('prodi_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg me-2"></i>Simpan Perubahan</button>
            <a href="{{ route('mata_kuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
