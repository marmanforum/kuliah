@extends('layouts.app')

@section('title', $mataKuliah->nama_mata_kuliah)

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Detail</span>
        <h1 class="page-title">Detail Mata Kuliah</h1>
    </div>
    <a href="{{ route('mata_kuliah.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="detail-panel">
    <div class="profile-hero">
        <div class="profile-avatar d-flex align-items-center justify-content-center bg-light text-primary fs-2">
            <i class="bi bi-journal-bookmark-fill"></i>
        </div>

        <div class="profile-content">
            <h2>{{ $mataKuliah->nama_mata_kuliah }}</h2>
            <div class="detail-meta">
                <span class="chip">{{ $mataKuliah->sks }} SKS</span>
                <span class="chip">{{ $mataKuliah->prodi?->nama_prodi ?? '-' }}</span>
            </div>
            <div class="form-actions mt-3">
                <a href="{{ route('mata_kuliah.edit', $mataKuliah) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-2"></i>Edit</a>
            </div>
        </div>
    </div>

    <div class="detail-list">
        <div class="detail-item" style="grid-column: 1 / -1;">
            <span class="label">Mahasiswa yang Mengambil</span>
            @if($mataKuliah->mahasiswa->isNotEmpty())
                <ul class="mb-0 ps-3 mt-2">
                    @foreach($mataKuliah->mahasiswa as $mahasiswa)
                        <li>{{ $mahasiswa->nama_mahasiswa }} ({{ $mahasiswa->nim }})</li>
                    @endforeach
                </ul>
            @else
                <span class="value d-block">-</span>
            @endif
        </div>
        <div class="detail-item">
            <span class="label">Program Studi</span>
            <span class="value">{{ $mataKuliah->prodi?->nama_prodi ?? '-' }}</span>
        </div>
    </div>
</div>
@endsection