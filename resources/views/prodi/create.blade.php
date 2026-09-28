@extends('layouts.app')

@section('title', 'Tambah Prodi')

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Tambah data</span>
        <h1 class="page-title">Tambah Program Studi</h1>
    </div>
    <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="form-panel">
    <form action="{{ route('prodi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <div class="form-field">
                <label for="nama_prodi">Nama Program Studi</label>
                <input id="nama_prodi" name="nama_prodi" value="{{ old('nama_prodi') }}" class="form-control @error('nama_prodi') is-invalid @enderror" required>
                @error('nama_prodi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-field">
                <label for="akreditasi">Akreditasi</label>
                <select id="akreditasi" name="akreditasi" class="form-select @error('akreditasi') is-invalid @enderror" required>
                    <option value="">Pilih Akreditasi</option>
                    <option value="unggul" @selected(old('akreditasi') === 'unggul')>Unggul</option>
                    <option value="baik" @selected(old('akreditasi') === 'baik')>Baik</option>
                    <option value="sangat baik" @selected(old('akreditasi') === 'sangat baik')>Sangat Baik</option>
                    <option value="belum terakreditasi" @selected(old('akreditasi') === 'belum terakreditasi')>Belum Terakreditasi</option>
                </select>
                @error('akreditasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-field">
            <label for="foto_profil">Foto Profil</label>
            <div class="upload-box">
                <div class="upload-preview" id="preview-foto-prodi">
                    <img src="https://placehold.co/120x120/f4f7ff/0d1b4c?text=Logo" alt="Preview foto prodi">
                </div>
                <input id="foto_profil" name="foto_profil" type="file" accept="image/*" class="form-control image-upload @error('foto_profil') is-invalid @enderror" data-preview-id="preview-foto-prodi">
            </div>
            @error('foto_profil')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg me-2"></i>Simpan</button>
            <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
