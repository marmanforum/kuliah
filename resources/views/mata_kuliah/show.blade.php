@extends('layouts.app')

@section('title', $mataKuliah->nama_mata_kuliah)

@section('content')
<div class="page-header detail-page-header">
    <div>
        <span class="section-tag">Detail</span>
        <h1 class="page-title">Detail Mata Kuliah</h1>
        <nav class="detail-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>/</span>
            <a href="{{ route('mata_kuliah.index') }}">Mata Kuliah</a>
            <span>/</span>
            <span>Detail</span>
        </nav>
    </div>
    <a href="{{ route('mata_kuliah.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="detail-shell">
    <div class="detail-panel premium-detail-panel">
        <div class="course-hero">
            <div class="course-photo-frame">
                @if($mataKuliah->foto_mata_kuliah)
                    <img src="{{ asset('storage/' . $mataKuliah->foto_mata_kuliah) }}" alt="{{ $mataKuliah->nama_mata_kuliah }}" class="course-photo-img">
                @else
                    <div class="course-photo-placeholder">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                @endif
            </div>

            <div class="course-hero-content">
                <span class="course-eyebrow">MATA KULIAH</span>
                <h2>{{ $mataKuliah->nama_mata_kuliah }}</h2>

                <div class="course-badges">
                    <span class="chip chip-primary">{{ $mataKuliah->sks }} SKS</span>
                    <span class="chip chip-soft">{{ $mataKuliah->prodi?->nama_prodi ?? 'Belum ada program studi' }}</span>
                </div>

                <div class="course-hero-actions">
                    <a href="{{ route('mata_kuliah.edit', $mataKuliah) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                </div>
            </div>
        </div>

        <div class="info-stat-grid">
            <div class="info-stat-card">
                <span class="info-stat-label">SKS</span>
                <strong class="info-stat-value">{{ $mataKuliah->sks ?? 0 }}</strong>
            </div>
            <div class="info-stat-card">
                <span class="info-stat-label">Program Studi</span>
                <strong class="info-stat-value">{{ $mataKuliah->prodi?->nama_prodi ?? 'Belum ada program studi' }}</strong>
            </div>
            <div class="info-stat-card">
                <span class="info-stat-label">Mahasiswa</span>
                <strong class="info-stat-value">{{ $mataKuliah->mahasiswa->count() }} Mahasiswa</strong>
            </div>
        </div>

        <div class="detail-lower-grid">
            <div class="detail-section-card student-section-card">
                <div class="section-header-row">
                    <div>
                        <span class="section-kicker">Daftar</span>
                        <h3>Mahasiswa yang Mengambil Mata Kuliah</h3>
                    </div>
                </div>

                @if($mataKuliah->mahasiswa->isNotEmpty())
                    <div class="student-grid">
                        @foreach($mataKuliah->mahasiswa as $index => $mahasiswa)
                            <div class="student-card">
                                <div class="student-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="student-photo-wrap">
                                    @if($mahasiswa->foto_mahasiswa)
                                        <img src="{{ asset('storage/' . $mahasiswa->foto_mahasiswa) }}" alt="{{ $mahasiswa->nama_mahasiswa }}" class="student-photo">
                                    @else
                                        <div class="student-photo-placeholder">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="student-info">
                                    <strong>{{ $mahasiswa->nama_mahasiswa }}</strong>
                                    <span>{{ $mahasiswa->nim }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state-card">
                        <div class="empty-state-icon"><i class="bi bi-people"></i></div>
                        <p>Belum ada mahasiswa yang mengambil mata kuliah ini.</p>
                    </div>
                @endif
            </div>

            <div class="detail-section-card prodi-side-card">
                <div class="section-header-row compact-header">
                    <div>
                        <span class="section-kicker">Data</span>
                        <h3>Program Studi</h3>
                    </div>
                </div>

                <div class="prodi-mini-card">
                    <div class="prodi-mini-icon"><i class="bi bi-building"></i></div>
                    <div>
                        <span class="prodi-mini-label">Program Studi</span>
                        <strong>{{ $mataKuliah->prodi?->nama_prodi ?? 'Belum ada program studi' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-actions-row">
            <a href="{{ route('mata_kuliah.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('mata_kuliah.edit', $mataKuliah) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-2"></i>Edit</a>
        </div>
    </div>
</div>
@endsection