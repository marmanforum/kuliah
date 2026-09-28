@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Perbarui data</span>
        <h1 class="page-title">Edit Mahasiswa</h1>
    </div>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="form-panel">
    <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-field">
                <label for="nim">NIM</label>
                <input id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="form-control @error('nim') is-invalid @enderror" required>
                @error('nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-field">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" class="form-control @error('nama_mahasiswa') is-invalid @enderror" required>
                @error('nama_mahasiswa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-field">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">Pilih jenis kelamin</option>
                    <option value="Laki-laki" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'Perempuan')>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-field">
                <label for="prodi_id">Program Studi</label>
                <select id="prodi_id" name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror" required>
                    <option value="">Pilih prodi</option>
                    @foreach($prodi as $item)
                        <option value="{{ $item->id }}" @selected(old('prodi_id', $mahasiswa->prodi_id) == $item->id)>{{ $item->nama_prodi }}</option>
                    @endforeach
                </select>
                @error('prodi_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-field">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-field">
            <label for="foto_mahasiswa">Foto Mahasiswa</label>
            <div class="upload-box">
                <div class="upload-preview {{ $mahasiswa->foto_mahasiswa ? 'has-image' : '' }}" id="preview-foto-mahasiswa">
                    @if($mahasiswa->foto_mahasiswa)
                        <img src="{{ Storage::url($mahasiswa->foto_mahasiswa) }}" alt="Foto {{ $mahasiswa->nama_mahasiswa }}">
                    @else
                        <img src="https://placehold.co/120x120/eaf0ff/0d1b4c?text=Foto" alt="Preview foto mahasiswa">
                    @endif
                </div>
                <input id="foto_mahasiswa" name="foto_mahasiswa" type="file" accept="image/*" class="form-control image-upload @error('foto_mahasiswa') is-invalid @enderror" data-preview-id="preview-foto-mahasiswa">
            </div>
            @error('foto_mahasiswa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg me-2"></i>Simpan Perubahan</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
