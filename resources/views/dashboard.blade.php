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

<div class="dashboard-focus">
    <section class="dashboard-focus-panel" aria-labelledby="dashboard-academic-title">
        <header class="dashboard-focus-header">
            <div>
                <span class="dashboard-focus-eyebrow">Pusat Akademik</span>
                <h2 id="dashboard-academic-title">Ringkasan Akademik</h2>
                <p>Gambaran singkat kondisi program studi.</p>
            </div>
            <a href="{{ route('prodi.index') }}" class="dashboard-focus-all">Lihat Semua <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
        </header>

        <div class="dashboard-prodi-list">
            @forelse($prodiList as $item)
                @php
                    $prodiIcons = ['bi-diagram-3-fill', 'bi-buildings-fill', 'bi-stars', 'bi-mortarboard-fill'];
                    $prodiIcon = $prodiIcons[$loop->index % count($prodiIcons)];
                @endphp
                <article class="dashboard-prodi-card dashboard-prodi-accent-{{ $loop->iteration % 4 }}">
                    <div class="dashboard-prodi-topline">
                        <span class="dashboard-prodi-icon"><i class="bi {{ $prodiIcon }}" aria-hidden="true"></i></span>
                        <span class="dashboard-accreditation">{{ ucwords($item->akreditasi) }}</span>
                    </div>
                    <h3>{{ $item->nama_prodi }}</h3>
                    <div class="dashboard-prodi-metrics">
                        <span><i class="bi bi-people-fill" aria-hidden="true"></i><strong>{{ $item->mahasiswa_count }}</strong> Mahasiswa</span>
                        <span><i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i><strong>{{ $item->mata_kuliah_count }}</strong> Mata Kuliah</span>
                    </div>
                    <a href="{{ route('prodi.show', $item) }}" class="dashboard-card-link">Informasi Program Studi <i class="bi bi-arrow-up-right" aria-hidden="true"></i></a>
                </article>
            @empty
                <div class="dashboard-focus-empty">Belum ada program studi.</div>
            @endforelse
        </div>
    </section>

    <section class="dashboard-focus-panel" aria-labelledby="dashboard-courses-title">
        <header class="dashboard-focus-header">
            <div>
                <span class="dashboard-focus-eyebrow">Aktivitas Perkuliahan</span>
                <h2 id="dashboard-courses-title">Mata Kuliah Terbaru</h2>
                <p>Daftar mata kuliah yang tersedia.</p>
            </div>
            <a href="{{ route('mata_kuliah.index') }}" class="dashboard-focus-all">Lihat Semua <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
        </header>

        <div class="dashboard-course-list">
            @forelse($mataKuliahTerbaru as $item)
                <article class="dashboard-course-card">
                    <span class="dashboard-course-icon"><i class="bi bi-book-half" aria-hidden="true"></i></span>
                    <div class="dashboard-course-copy">
                        <h3>{{ $item->nama_mata_kuliah }}</h3>
                        <span class="dashboard-course-prodi"><i class="bi bi-diagram-3" aria-hidden="true"></i>{{ $item->prodi?->nama_prodi ?? 'Belum Mengikuti Prodi' }}</span>
                        <span class="dashboard-course-enrollment"><i class="bi bi-people-fill" aria-hidden="true"></i>{{ $item->mahasiswa->count() }} Mahasiswa</span>
                    </div>
                    <div class="dashboard-course-end">
                        <span class="dashboard-sks">{{ $item->sks }} SKS</span>
                        <a href="{{ route('mata_kuliah.show', $item) }}" class="dashboard-course-link" aria-label="Lihat {{ $item->nama_mata_kuliah }}"><i class="bi bi-arrow-up-right" aria-hidden="true"></i></a>
                    </div>
                </article>
            @empty
                <div class="dashboard-focus-empty">Belum ada mata kuliah terbaru.</div>
            @endforelse
        </div>
    </section>
</div>

<style>
    .dashboard-focus {
        --dashboard-navy: #10264f;
        --dashboard-blue: #2563a6;
        --dashboard-muted: #718096;
        --dashboard-line: #e3eaf2;
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
        align-items: start;
        gap: 1.2rem;
        margin: 1.6rem 0 2rem;
    }
    .dashboard-focus-panel {
        min-width: 0;
        padding: 1.35rem;
        background: rgba(255, 255, 255, .94);
        border: 1px solid var(--dashboard-line);
        border-radius: 20px;
        box-shadow: 0 12px 32px rgba(16, 38, 79, .055);
    }
    .dashboard-focus-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .8rem;
        margin-bottom: 1rem;
    }
    .dashboard-focus-eyebrow {
        color: var(--dashboard-blue);
        font-size: .65rem;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }
    .dashboard-focus-header h2 {
        margin: .25rem 0 0;
        color: var(--dashboard-navy);
        font-size: 1.2rem;
        font-weight: 800;
    }
    .dashboard-focus-header p {
        margin: .3rem 0 0;
        color: var(--dashboard-muted);
        font-size: .76rem;
    }
    .dashboard-focus-all {
        display: inline-flex;
        flex: 0 0 auto;
        align-items: center;
        gap: .35rem;
        padding: .5rem .65rem;
        color: var(--dashboard-blue);
        background: #edf5ff;
        border: 1px solid #dceafd;
        border-radius: 11px;
        font-size: .7rem;
        font-weight: 750;
        transition: color .2s ease, background .2s ease, transform .2s ease;
    }
    .dashboard-focus-all:hover { color: #fff; background: var(--dashboard-blue); transform: translateY(-1px); }
    .dashboard-prodi-list,.dashboard-course-list { display: grid; gap: .75rem; }
    .dashboard-prodi-card {
        position: relative;
        min-width: 0;
        padding: .95rem 1rem .85rem;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--dashboard-line);
        border-radius: 16px;
        box-shadow: 0 5px 16px rgba(16, 38, 79, .035);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }
    .dashboard-prodi-card:hover,.dashboard-course-card:hover {
        transform: translateY(-3px);
        border-color: #c7d7e9;
        box-shadow: 0 13px 25px rgba(16, 38, 79, .09);
    }
    .dashboard-prodi-accent-1 { border-left: 3px solid #2c6c9d; }
    .dashboard-prodi-accent-2 { border-left: 3px solid #b3913d; }
    .dashboard-prodi-accent-3 { border-left: 3px solid #43836f; }
    .dashboard-prodi-accent-0 { border-left: 3px solid #7186ae; }
    .dashboard-prodi-topline { display: flex; align-items: center; justify-content: space-between; gap: .7rem; }
    .dashboard-prodi-icon,.dashboard-course-icon {
        display: grid;
        place-items: center;
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        color: var(--dashboard-blue);
        background: #edf5ff;
        border-radius: 12px;
        font-size: .95rem;
    }
    .dashboard-prodi-accent-2 .dashboard-prodi-icon { color: #98751d; background: #fff7df; }
    .dashboard-prodi-accent-3 .dashboard-prodi-icon { color: #34725e; background: #eaf5ef; }
    .dashboard-accreditation {
        padding: .32rem .55rem;
        color: #755a13;
        background: #fff7df;
        border: 1px solid #f1dfaa;
        border-radius: 999px;
        font-size: .61rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .dashboard-prodi-card h3 {
        margin: .65rem 0 .55rem;
        color: var(--dashboard-navy);
        font-size: .98rem;
        font-weight: 800;
        overflow-wrap: anywhere;
    }
    .dashboard-prodi-metrics { display: flex; flex-wrap: wrap; gap: .45rem 1rem; }
    .dashboard-prodi-metrics span {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        color: var(--dashboard-muted);
        font-size: .69rem;
    }
    .dashboard-prodi-metrics i { color: var(--dashboard-blue); }
    .dashboard-prodi-metrics strong { color: var(--dashboard-navy); font-size: .75rem; }
    .dashboard-card-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
        margin-top: .7rem;
        padding-top: .6rem;
        color: var(--dashboard-blue);
        border-top: 1px solid #edf1f6;
        font-size: .68rem;
        font-weight: 750;
    }
    .dashboard-course-card {
        display: flex;
        align-items: center;
        gap: .75rem;
        min-width: 0;
        padding: .85rem;
        background: #fff;
        border: 1px solid var(--dashboard-line);
        border-radius: 16px;
        box-shadow: 0 5px 16px rgba(16, 38, 79, .035);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }
    .dashboard-course-icon { flex-basis: 42px; width: 42px; height: 42px; color: #9a761e; background: #fff7df; font-size: 1rem; }
    .dashboard-course-copy { flex: 1; min-width: 0; }
    .dashboard-course-copy h3 { margin: 0; color: var(--dashboard-navy); font-size: .82rem; font-weight: 800; line-height: 1.35; overflow-wrap: anywhere; }
    .dashboard-course-prodi,.dashboard-course-enrollment { display: inline-flex; align-items: center; gap: .3rem; margin-top: .35rem; color: var(--dashboard-muted); font-size: .66rem; }
    .dashboard-course-prodi { margin-right: .55rem; }
    .dashboard-course-prodi i,.dashboard-course-enrollment i { color: var(--dashboard-blue); }
    .dashboard-course-end { display: flex; flex-direction: column; align-items: flex-end; gap: .45rem; }
    .dashboard-sks { padding: .3rem .48rem; color: #205a9c; background: #edf5ff; border: 1px solid #dceafd; border-radius: 999px; font-size: .62rem; font-weight: 800; white-space: nowrap; }
    .dashboard-course-link { display: grid; place-items: center; width: 28px; height: 28px; color: var(--dashboard-blue); background: #f2f6fa; border-radius: 9px; }
    .dashboard-course-link:hover { color: #fff; background: var(--dashboard-blue); }
    .dashboard-focus-empty { padding: 1.4rem .8rem; color: var(--dashboard-muted); background: #f8fafd; border: 1px dashed #d6e0ec; border-radius: 15px; font-size: .78rem; text-align: center; }
    @media (max-width: 991.98px) { .dashboard-focus { grid-template-columns: 1fr; } }
    @media (max-width: 575.98px) {
        .dashboard-focus-panel { padding: 1rem; border-radius: 17px; }
        .dashboard-focus-header { align-items: flex-start; }
        .dashboard-focus-header h2 { font-size: 1.08rem; }
        .dashboard-focus-header p { max-width: 210px; font-size: .7rem; }
        .dashboard-focus-all { padding: .45rem .55rem; font-size: .65rem; }
        .dashboard-prodi-metrics { gap: .4rem .7rem; }
        .dashboard-course-card { gap: .6rem; padding: .72rem; }
        .dashboard-course-icon { flex-basis: 36px; width: 36px; height: 36px; }
        .dashboard-course-prodi,.dashboard-course-enrollment { font-size: .62rem; }
    }
</style>
@endsection