@extends('layouts.app')

@section('title', $mahasiswa->nama_mahasiswa)

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Detail</span>
        <h1 class="page-title">Detail Mahasiswa</h1>
    </div>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="detail-panel">
    <div class="profile-hero">
        @if($mahasiswa->foto_mahasiswa)
            <img src="{{ Storage::url($mahasiswa->foto_mahasiswa) }}" alt="Foto {{ $mahasiswa->nama_mahasiswa }}" class="profile-avatar">
        @else
            <div class="profile-avatar d-flex align-items-center justify-content-center bg-light text-primary fs-2">
                <i class="bi bi-person-fill"></i>
            </div>
        @endif

        <div class="profile-content">
            <h2>{{ $mahasiswa->nama_mahasiswa }}</h2>
            <div class="detail-meta">
                <span class="chip">NIM: {{ $mahasiswa->nim }}</span>
                <span class="chip">{{ $mahasiswa->jenis_kelamin }}</span>
            </div>
            <div class="form-actions mt-3">
                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-2"></i>Edit</a>
            </div>
        </div>
    </div>

    <div class="detail-list">
        <div class="detail-item">
            <span class="label">Alamat</span>
            <span class="value">{{ $mahasiswa->alamat }}</span>
        </div>
        <div class="detail-item">
            <span class="label">Program Studi</span>
            <span class="value">{{ $mahasiswa->prodi?->nama_prodi ?? '-' }}</span>
        </div>
    </div>

    <div class="info-card mt-4">
        <div class="card-title">
            <h2 class="card-heading">Mata Kuliah</h2>
        </div>
        @if($mahasiswa->mataKuliah->isNotEmpty())
            <div class="list-stack">
                @foreach($mahasiswa->mataKuliah as $item)
                    <div class="list-row">
                        <div>
                            <strong>{{ $item->nama_mata_kuliah }}</strong>
                            <div class="mini-meta">{{ $item->sks }} SKS · {{ $item->prodi?->nama_prodi ?? '-' }}</div>
                        </div>
                        <a href="{{ route('mata_kuliah.show', $item) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0">Belum ada mata kuliah yang diambil mahasiswa ini.</p>
        @endif
    </div>
</div>
@endsection