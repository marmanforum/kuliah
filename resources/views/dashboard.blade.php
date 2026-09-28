@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    $prodiList = \App\Models\Prodi::withCount(['mahasiswa', 'mataKuliah'])->orderBy('nama_prodi')->limit(4)->get();
    $mataKuliahTerbaru = \App\Models\MataKuliah::with(['prodi', 'mahasiswa'])->orderByDesc('id')->limit(4)->get();
@endphp

<div class="welcome-panel">
    <div class="welcome-header">
        <div class="welcome-copy">
            <span class="welcome-badge"><i class="bi bi-shield-check me-2"></i> Portal Akademik</span>
            <h1>Sistem Informasi Akademik</h1>
            <p>Kelola data akademik dengan mudah dan terintegrasi untuk mendukung layanan pendidikan yang lebih profesional.</p>
        </div>
    </div>
</div>

<div class="stat-grid">
    <a href="{{ route('prodi.index') }}" class="stat-card text-decoration-none">
        <div class="stat-card-inner">
            <div>
                <div class="stat-label">Total Program Studi</div>
                <div class="stat-value">{{ $jumlahProdi }}</div>
            </div>
            <div class="stat-icon navy"><i class="bi bi-diagram-3-fill"></i></div>
        </div>
    </a>

    <a href="{{ route('mahasiswa.index') }}" class="stat-card text-decoration-none">
        <div class="stat-card-inner">
            <div>
                <div class="stat-label">Total Mahasiswa</div>
                <div class="stat-value">{{ $jumlahMahasiswa }}</div>
            </div>
            <div class="stat-icon green"><i class="bi bi-people-fill"></i></div>
        </div>
    </a>

    <a href="{{ route('mata_kuliah.index') }}" class="stat-card text-decoration-none">
        <div class="stat-card-inner">
            <div>
                <div class="stat-label">Total Mata Kuliah</div>
                <div class="stat-value">{{ $jumlahMataKuliah }}</div>
            </div>
            <div class="stat-icon gold"><i class="bi bi-journal-bookmark-fill"></i></div>
        </div>
    </a>
</div>

<div class="summary-grid">
    <div class="info-card">
        <div class="card-title">
            <h2 class="card-heading">Ringkasan Akademik</h2>
            <a href="{{ route('prodi.index') }}" class="btn btn-sm btn-outline-primary">Lihat semua</a>
        </div>

        <ul class="mini-list">
            @foreach($prodiList as $item)
                <li>
                    <div>
                        <strong>{{ $item->nama_prodi }}</strong>
                        <span class="mini-meta">{{ $item->mahasiswa_count }} mahasiswa · {{ $item->mata_kuliah_count }} mata kuliah</span>
                    </div>
                    <span class="chip">{{ $item->akreditasi }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="info-card">
        <div class="card-title">
            <h2 class="card-heading">Mata Kuliah Terbaru</h2>
            <a href="{{ route('mata_kuliah.index') }}" class="btn btn-sm btn-outline-primary">Lihat</a>
        </div>

        <ul class="mini-list">
            @foreach($mataKuliahTerbaru as $item)
                @php
                    $mahasiswaLabel = $item->mahasiswa->isNotEmpty()
                        ? $item->mahasiswa->take(2)->pluck('nama_mahasiswa')->implode(', ')
                        : '-';
                @endphp
                <li>
                    <div>
                        <strong>{{ $item->nama_mata_kuliah }}</strong>
                        <span class="mini-meta">{{ $item->prodi?->nama_prodi ?? '-' }} · {{ $item->sks }} SKS</span>
                    </div>
                    <span class="chip">{{ $mahasiswaLabel }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection