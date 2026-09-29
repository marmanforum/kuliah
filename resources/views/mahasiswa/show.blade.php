@extends('layouts.app')

@section('title', $mahasiswa->nama_mahasiswa)

@section('content')
<div class="student-profile">
            <header class="student-page-header">
                <div>
                    <nav class="student-breadcrumb" aria-label="Breadcrumb">
                        <a href="{{ route('dashboard') }}">Dashboard</a><i class="bi bi-chevron-right" aria-hidden="true"></i>
                        <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a><i class="bi bi-chevron-right" aria-hidden="true"></i><span>Detail</span>
                    </nav>
                    <span class="student-kicker">Detail</span>
                    <h1 class="page-title">Detail Mahasiswa</h1>
                </div>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary student-back"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali</a>
            </header>

            <section class="student-hero" aria-labelledby="student-name">
                <div class="student-photo-wrap">
                    @if($mahasiswa->foto_mahasiswa)
                        <img src="{{ Storage::url($mahasiswa->foto_mahasiswa) }}" alt="Foto {{ $mahasiswa->nama_mahasiswa }}" class="student-photo">
                    @else
                        <div class="student-photo student-photo-empty" role="img" aria-label="Foto mahasiswa belum tersedia"><i class="bi bi-person-fill" aria-hidden="true"></i></div>
                    @endif
                </div>
                <div class="student-identity">
                    <span class="student-eyebrow"><i class="bi bi-mortarboard-fill" aria-hidden="true"></i> Profil Mahasiswa</span>
                    <h2 id="student-name">{{ $mahasiswa->nama_mahasiswa }}</h2>
                    <div class="student-badges">
                        <span class="student-badge student-badge-blue"><i class="bi bi-person-vcard" aria-hidden="true"></i> NIM {{ $mahasiswa->nim }}</span>
                        <span class="student-badge"><i class="bi bi-gender-ambiguous" aria-hidden="true"></i> {{ $mahasiswa->jenis_kelamin }}</span>
                    </div>
                    <div class="student-hero-actions">
                        <div class="student-stat"><i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i><span><strong>{{ $mahasiswa->mataKuliah->count() }}</strong><small>Mata Kuliah</small></span></div>
                        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning student-edit"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Profil</a>
                    </div>
                </div>
                <i class="bi bi-mortarboard-fill student-watermark" aria-hidden="true"></i>
            </section>

            <section class="student-section" aria-labelledby="academic-title">
                <div class="student-section-heading"><div><span>DATA AKADEMIK</span><h2 id="academic-title">Informasi Akademik</h2></div><i class="bi bi-building" aria-hidden="true"></i></div>
                <div class="student-academic-grid">
                    <article class="student-info-card"><i class="bi bi-person-vcard" aria-hidden="true"></i><div><small>NIM</small><strong>{{ $mahasiswa->nim ?: '-' }}</strong></div></article>
                    <article class="student-info-card"><i class="bi bi-gender-ambiguous" aria-hidden="true"></i><div><small>Jenis Kelamin</small><strong>{{ $mahasiswa->jenis_kelamin ?: '-' }}</strong></div></article>
                    <article class="student-info-card"><i class="bi bi-mortarboard" aria-hidden="true"></i><div><small>Program Studi</small><strong>{{ $mahasiswa->prodi?->nama_prodi ?? 'Belum Mengikuti Prodi' }}</strong></div></article>
                </div>
            </section>

            <section class="student-section" aria-labelledby="personal-title">
                <div class="student-section-heading"><div><span>DATA MAHASISWA</span><h2 id="personal-title">Informasi Pribadi</h2></div><i class="bi bi-clipboard2-check" aria-hidden="true"></i></div>
                <article class="student-address-card"><i class="bi bi-geo-alt-fill" aria-hidden="true"></i><div><small>Alamat</small><p>{{ $mahasiswa->alamat ?: '-' }}</p></div></article>
            </section>

            <section class="student-section" aria-labelledby="courses-title">
                <div class="student-section-heading student-course-heading"><div><span>PERKULIAHAN</span><h2 id="courses-title">Mata Kuliah yang Diambil</h2></div><strong class="student-course-count">{{ $mahasiswa->mataKuliah->count() }} Mata Kuliah</strong></div>
                @if($mahasiswa->mataKuliah->isNotEmpty())
                    <div class="student-course-grid">
                        @foreach($mahasiswa->mataKuliah as $item)
                            <article class="student-course-card">
                                <i class="bi bi-book-half student-course-icon" aria-hidden="true"></i>
                                <div class="student-course-copy"><h3>{{ $item->nama_mata_kuliah }}</h3><span><i class="bi bi-building" aria-hidden="true"></i> Program Studi: {{ $item->prodi?->nama_prodi ?? 'Belum Mengikuti Prodi' }}</span></div>
                                <div class="student-course-meta"><strong>{{ $item->sks }}</strong><small>SKS</small><a href="{{ route('mata_kuliah.show', $item) }}" aria-label="Lihat {{ $item->nama_mata_kuliah }}"><i class="bi bi-arrow-up-right" aria-hidden="true"></i></a></div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="student-empty"><i class="bi bi-journal-x" aria-hidden="true"></i><h3>Belum Ada Mata Kuliah</h3><p>Mahasiswa ini belum mengambil mata kuliah.</p></div>
                @endif
            </section>
        </div>

        <style>
            .student-profile { --sp-navy: #10264f; --sp-blue: #2563a6; --sp-muted: #718096; --sp-line: #e3eaf2; max-width: 1200px; margin: 0 auto 2rem; }
            .student-page-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; }
            .student-breadcrumb { display: flex; align-items: center; gap: .55rem; margin-bottom: .9rem; color: var(--sp-muted); font-size: .76rem; font-weight: 600; }
            .student-breadcrumb a { color: var(--sp-blue); }.student-breadcrumb i { font-size: .55rem; color: #a4b0c0; }
            .student-kicker { display: block; margin-bottom: .4rem; color: var(--sp-blue); font-size: .7rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; }
            .student-back { display: inline-flex; align-items: center; gap: .45rem; white-space: nowrap; }
            .student-hero { position: relative; display: grid; grid-template-columns: 160px minmax(0, 1fr); align-items: center; gap: 2rem; overflow: hidden; padding: 2rem 2.25rem; background: #fff; border: 1px solid var(--sp-line); border-radius: 22px; box-shadow: 0 18px 46px rgba(16,38,79,.09); }
            .student-photo-wrap { width: 160px; height: 178px; }.student-photo { width: 100%; height: 100%; object-fit: cover; border-radius: 20px; box-shadow: 0 12px 26px rgba(16,38,79,.18); transition: transform .25s ease, box-shadow .25s ease; }
            .student-photo-wrap:hover .student-photo { transform: translateY(-3px) scale(1.015); box-shadow: 0 18px 32px rgba(16,38,79,.22); }
            .student-photo-empty { display: grid; place-items: center; color: #6683a8; background: linear-gradient(145deg,#e7eef7,#f5f8fc); font-size: 4rem; }
            .student-identity { position: relative; z-index: 1; min-width: 0; }.student-eyebrow { display: block; margin-bottom: .55rem; color: var(--sp-blue); font-size: .72rem; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; }
            .student-identity h2 { margin: 0; color: var(--sp-navy); font-size: clamp(1.65rem,3vw,2.35rem); font-weight: 800; line-height: 1.2; overflow-wrap: anywhere; }
            .student-badges { display: flex; flex-wrap: wrap; gap: .6rem; margin-top: 1rem; }.student-badge { display: inline-flex; align-items: center; gap: .4rem; padding: .5rem .8rem; color: #465a75; background: #f3f6fa; border: 1px solid #e6edf5; border-radius: 999px; font-size: .78rem; font-weight: 700; }
            .student-badge-blue { color: #205a9c; background: #edf5ff; border-color: #dceafd; }.student-hero-actions { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-top: 1.5rem; }
            .student-stat { display: flex; align-items: center; gap: .7rem; color: var(--sp-blue); }.student-stat > i { display: grid; place-items: center; width: 42px; height: 42px; background: #edf5ff; border-radius: 13px; }
            .student-stat strong,.student-stat small { display: block; }.student-stat strong { color: var(--sp-navy); font-size: 1.05rem; line-height: 1.1; }.student-stat small { margin-top: .2rem; color: var(--sp-muted); font-size: .7rem; font-weight: 600; }
            .student-edit { display: inline-flex; align-items: center; gap: .45rem; }.student-watermark { position: absolute; top: -2.8rem; right: .5rem; color: rgba(37,99,166,.045); font-size: 13rem; pointer-events: none; }
            .student-section { margin-top: 2.25rem; }.student-section-heading { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1rem; }
            .student-section-heading span:not(.student-course-count) { color: var(--sp-blue); font-size: .67rem; font-weight: 800; letter-spacing: .12em; }.student-section-heading h2 { margin: .25rem 0 0; color: var(--sp-navy); font-size: 1.28rem; font-weight: 800; }
            .student-section-heading > i { display: grid; place-items: center; width: 42px; height: 42px; color: var(--sp-blue); background: #eaf2fb; border-radius: 14px; }
            .student-academic-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 1rem; }.student-info-card,.student-address-card { display: flex; align-items: center; gap: 1rem; min-width: 0; padding: 1.2rem; background: #fff; border: 1px solid var(--sp-line); border-radius: 18px; box-shadow: 0 8px 24px rgba(16,38,79,.045); transition: transform .22s ease,box-shadow .22s ease,border-color .22s ease; }
            .student-info-card:hover,.student-address-card:hover,.student-course-card:hover { transform: translateY(-3px); border-color: #cbdcf0; box-shadow: 0 14px 30px rgba(16,38,79,.09); }
            .student-info-card > i,.student-address-card > i { display: grid; place-items: center; flex: 0 0 46px; width: 46px; height: 46px; color: var(--sp-blue); background: #edf5ff; border-radius: 13px; font-size: 1.05rem; }
            .student-info-card > div,.student-address-card > div { min-width: 0; }.student-info-card small,.student-address-card small { display: block; margin-bottom: .3rem; color: var(--sp-muted); font-size: .71rem; font-weight: 700; }.student-info-card strong { color: var(--sp-navy); font-size: .93rem; overflow-wrap: anywhere; }
            .student-address-card { align-items: flex-start; }.student-address-card p { margin: 0; color: var(--sp-navy); font-size: .94rem; font-weight: 600; line-height: 1.6; overflow-wrap: anywhere; }
            .student-course-count { padding: .5rem .8rem; color: #205a9c; background: #edf5ff; border: 1px solid #dceafd; border-radius: 999px; font-size: .74rem; white-space: nowrap; }
            .student-course-grid { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 1rem; }.student-course-card { display: flex; align-items: center; gap: .9rem; min-width: 0; padding: 1.1rem; background: #fff; border: 1px solid var(--sp-line); border-radius: 18px; box-shadow: 0 8px 24px rgba(16,38,79,.045); transition: transform .22s ease,box-shadow .22s ease,border-color .22s ease; }
            .student-course-icon { flex: 0 0 44px; color: var(--sp-blue); font-size: 1.2rem; }.student-course-copy { flex: 1; min-width: 0; }.student-course-copy h3 { margin: 0; color: var(--sp-navy); font-size: .92rem; font-weight: 800; overflow-wrap: anywhere; }.student-course-copy span { display: block; margin-top: .4rem; color: var(--sp-muted); font-size: .71rem; line-height: 1.45; }.student-course-copy span i { color: var(--sp-blue); }
            .student-course-meta { display: grid; grid-template-columns: auto auto; align-items: baseline; gap: .15rem; color: var(--sp-navy); text-align: right; }.student-course-meta strong { font-size: .95rem; }.student-course-meta small { color: var(--sp-muted); font-size: .65rem; font-weight: 700; }.student-course-meta a { grid-column: 1/-1; justify-self: end; margin-top: .3rem; color: var(--sp-blue); }
            .student-empty { padding: 2.25rem 1rem; color: var(--sp-muted); background: #fff; border: 1px dashed #cfdae8; border-radius: 18px; text-align: center; }.student-empty > i { display: inline-grid; place-items: center; width: 52px; height: 52px; color: var(--sp-blue); background: #edf5ff; border-radius: 16px; font-size: 1.4rem; }.student-empty h3 { margin: .8rem 0 .3rem; color: var(--sp-navy); font-size: 1rem; font-weight: 800; }.student-empty p { margin: 0; font-size: .83rem; }
            @media (max-width: 767.98px) { .student-hero { grid-template-columns: 1fr; justify-items: center; gap: 1.2rem; padding: 1.5rem 1.2rem; text-align: center; }.student-photo-wrap { width: 150px; height: 165px; }.student-identity { width: 100%; }.student-badges,.student-hero-actions { justify-content: center; }.student-watermark { top: 1rem; right: -1.5rem; font-size: 9rem; }.student-academic-grid,.student-course-grid { grid-template-columns: 1fr; } }
            @media (max-width: 480px) { .student-page-header { align-items: flex-end; }.student-breadcrumb { gap: .35rem; font-size: .68rem; }.student-page-header .page-title { font-size: 1.7rem; }.student-back { padding: .65rem .8rem!important; font-size: .8rem!important; }.student-hero-actions { flex-direction: column; }.student-section-heading h2 { font-size: 1.1rem; }.student-course-card { gap: .65rem; padding: .9rem; }.student-course-copy h3 { font-size: .84rem; }.student-course-copy span { font-size: .66rem; } }
        </style>
    </div>
    @endsection