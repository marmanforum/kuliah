@extends('layouts.app')

@section('title', $prodi->nama_prodi)

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Detail</span>
        <h1 class="page-title">Detail Program Studi</h1>
    </div>
    <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="detail-panel">
    <div class="profile-hero">
        @if($prodi->foto_profil)
            <img src="{{ Storage::url($prodi->foto_profil) }}" alt="Foto {{ $prodi->nama_prodi }}" class="profile-avatar">
        @else
            <div class="profile-avatar d-flex align-items-center justify-content-center bg-light text-primary fs-2">
                <i class="bi bi-building"></i>
            </div>
        @endif

        <div class="profile-content">
            <h2>{{ $prodi->nama_prodi }}</h2>
            <div class="detail-meta">
                <span class="chip">Akreditasi: {{ $prodi->akreditasi }}</span>
                <span class="chip">{{ $prodi->mahasiswa->count() }} Mahasiswa</span>
                <span class="chip">{{ $prodi->mataKuliah->count() }} Mata Kuliah</span>
            </div>
            <div class="form-actions mt-3">
                <a href="{{ route('prodi.edit', $prodi) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-2"></i>Edit</a>
            </div>
        </div>
    </div>

    <div class="summary-grid">
        <div class="info-card">
            <div class="card-title">
                <h2 class="card-heading">Mahasiswa</h2>
            </div>
            @if($prodi->mahasiswa->isNotEmpty())
                <div class="list-stack">
                    @foreach($prodi->mahasiswa as $item)
                        <div class="list-row">
                            <div>
                                <strong>{{ $item->nama_mahasiswa }}</strong>
                                <div class="mini-meta">{{ $item->nim }}</div>
                            </div>
                            <a href="{{ route('mahasiswa.show', $item) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">Belum ada mahasiswa terdaftar pada program studi ini.</p>
            @endif
        </div>

        <div class="info-card">
            <div class="card-title">
                <h2 class="card-heading">Mata Kuliah</h2>
            </div>
            @if($prodi->mataKuliah->isNotEmpty())
                <div class="list-stack">
                    @foreach($prodi->mataKuliah as $item)
                        <div class="list-row">
                            <div>
                                <strong>{{ $item->nama_mata_kuliah }}</strong>
                                <div class="mini-meta">{{ $item->sks }} SKS</div>
                            </div>
                            <a href="{{ route('mata_kuliah.show', $item) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">Belum ada mata kuliah di program studi ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection