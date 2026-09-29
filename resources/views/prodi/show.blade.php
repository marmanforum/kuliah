@extends('layouts.app')

@section('title', $prodi->nama_prodi)

@section('content')
<div class="prodi-detail-page">
    <header class="prodi-detail-header">
        <div>
            <nav class="prodi-detail-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                <a href="{{ route('prodi.index') }}">Program Studi</a>
                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                <span>Detail</span>
            </nav>
            <span class="prodi-detail-kicker">Direktori Akademik</span>
            <h1>Detail Program Studi</h1>
        </div>
        <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary prodi-detail-back"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali</a>
    </header>

    <section class="prodi-detail-hero" aria-labelledby="prodi-detail-name">
        <div class="prodi-detail-photo-wrap">
            @if($prodi->foto_profil)
                <img src="{{ Storage::url($prodi->foto_profil) }}" alt="Foto {{ $prodi->nama_prodi }}" class="prodi-detail-photo">
            @else
                <div class="prodi-detail-photo prodi-detail-photo-placeholder" role="img" aria-label="Foto program studi belum tersedia"><i class="bi bi-building" aria-hidden="true"></i></div>
            @endif
        </div>
        <div class="prodi-detail-identity">
            <span class="prodi-detail-label"><i class="bi bi-mortarboard-fill" aria-hidden="true"></i> Program Studi</span>
            <h2 id="prodi-detail-name">{{ $prodi->nama_prodi }}</h2>
            <span class="prodi-detail-accreditation"><i class="bi bi-patch-check-fill" aria-hidden="true"></i> Akreditasi {{ ucwords($prodi->akreditasi) }}</span>
            <div class="prodi-detail-hero-meta">
                <span><i class="bi bi-people-fill" aria-hidden="true"></i>{{ $prodi->mahasiswa->count() }} Mahasiswa</span>
                <span><i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i>{{ $prodi->mataKuliah->count() }} Mata Kuliah</span>
            </div>
            <div class="prodi-detail-actions">
                <a href="{{ route('prodi.edit', $prodi) }}" class="btn btn-warning"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Program Studi</a>
            </div>
        </div>
        <i class="bi bi-mortarboard-fill prodi-detail-watermark" aria-hidden="true"></i>
    </section>

    <section class="prodi-detail-stats" aria-label="Ringkasan program studi">
        <article class="prodi-detail-stat-card">
            <span class="prodi-detail-stat-icon"><i class="bi bi-people-fill" aria-hidden="true"></i></span>
            <div><small>Jumlah Mahasiswa</small><strong>{{ $prodi->mahasiswa->count() }}</strong></div>
        </article>
        <article class="prodi-detail-stat-card">
            <span class="prodi-detail-stat-icon prodi-detail-stat-blue"><i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i></span>
            <div><small>Jumlah Mata Kuliah</small><strong>{{ $prodi->mataKuliah->count() }}</strong></div>
        </article>
        <article class="prodi-detail-stat-card">
            <span class="prodi-detail-stat-icon prodi-detail-stat-gold"><i class="bi bi-patch-check-fill" aria-hidden="true"></i></span>
            <div><small>Status Akreditasi</small><strong>{{ ucwords($prodi->akreditasi) }}</strong></div>
        </article>
    </section>

    <section class="prodi-detail-section" aria-labelledby="prodi-students-title">
        <div class="prodi-detail-section-heading">
            <div><span>ANGGOTA AKADEMIK</span><h2 id="prodi-students-title">Mahasiswa Terdaftar</h2></div>
            <span class="prodi-detail-count">{{ $prodi->mahasiswa->count() }} mahasiswa</span>
        </div>
        @if($prodi->mahasiswa->isNotEmpty())
            <div class="prodi-detail-student-grid">
                @foreach($prodi->mahasiswa as $item)
                    <article class="prodi-detail-student-card">
                        @if($item->foto_mahasiswa)
                            <img src="{{ Storage::url($item->foto_mahasiswa) }}" alt="Foto {{ $item->nama_mahasiswa }}" class="prodi-detail-student-photo">
                        @else
                            <span class="prodi-detail-student-placeholder" aria-hidden="true"><i class="bi bi-person-fill"></i></span>
                        @endif
                        <div class="prodi-detail-card-copy"><h3>{{ $item->nama_mahasiswa }}</h3><span>NIM {{ $item->nim }}</span></div>
                        <a href="{{ route('mahasiswa.show', $item) }}" class="prodi-detail-link" aria-label="Lihat detail {{ $item->nama_mahasiswa }}"><i class="bi bi-arrow-up-right" aria-hidden="true"></i></a>
                    </article>
                @endforeach
            </div>
        @else
            <div class="prodi-detail-empty"><i class="bi bi-people" aria-hidden="true"></i><h3>Belum ada mahasiswa</h3><p>Belum ada mahasiswa terdaftar pada program studi ini.</p></div>
        @endif
    </section>

    <section class="prodi-detail-section" aria-labelledby="prodi-courses-title">
        <div class="prodi-detail-section-heading">
            <div><span>KURIKULUM</span><h2 id="prodi-courses-title">Mata Kuliah</h2></div>
            <span class="prodi-detail-count">{{ $prodi->mataKuliah->count() }} mata kuliah</span>
        </div>
        @if($prodi->mataKuliah->isNotEmpty())
            <div class="prodi-detail-course-grid">
                @foreach($prodi->mataKuliah as $item)
                    <article class="prodi-detail-course-card">
                        <span class="prodi-detail-course-icon"><i class="bi bi-book-half" aria-hidden="true"></i></span>
                        <div class="prodi-detail-card-copy"><h3>{{ $item->nama_mata_kuliah }}</h3><span><i class="bi bi-people" aria-hidden="true"></i> {{ $item->mahasiswa->count() }} mahasiswa</span></div>
                        <div class="prodi-detail-course-end"><strong>{{ $item->sks }}</strong><small>SKS</small><a href="{{ route('mata_kuliah.show', $item) }}" class="prodi-detail-link" aria-label="Lihat detail {{ $item->nama_mata_kuliah }}"><i class="bi bi-arrow-up-right" aria-hidden="true"></i></a></div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="prodi-detail-empty"><i class="bi bi-journal-x" aria-hidden="true"></i><h3>Belum ada mata kuliah</h3><p>Belum ada mata kuliah di program studi ini.</p></div>
        @endif
    </section>
</div>

<style>
    .prodi-detail-page { --pd-navy: #10264f; --pd-blue: #2563a6; --pd-muted: #718096; --pd-line: #e3eaf2; width: 100%; max-width: 1280px; margin: 0 auto 2rem; }
    .prodi-detail-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; }
    .prodi-detail-breadcrumb { display: flex; align-items: center; gap: .55rem; margin-bottom: .9rem; color: var(--pd-muted); font-size: .76rem; font-weight: 600; }
    .prodi-detail-breadcrumb a { color: var(--pd-blue); }.prodi-detail-breadcrumb i { color: #a4b0c0; font-size: .55rem; }
    .prodi-detail-kicker { display: block; margin-bottom: .35rem; color: var(--pd-blue); font-size: .69rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; }
    .prodi-detail-header h1 { margin: 0; color: var(--pd-navy); font-size: 1.85rem; font-weight: 800; line-height: 1.2; }
    .prodi-detail-back { display: inline-flex; align-items: center; gap: .45rem; white-space: nowrap; }
    .prodi-detail-hero { position: relative; display: grid; grid-template-columns: 196px minmax(0,1fr); align-items: center; gap: 2rem; overflow: hidden; padding: 1.75rem 2rem; background: #fff; border: 1px solid var(--pd-line); border-radius: 22px; box-shadow: 0 16px 42px rgba(16,38,79,.075); }
    .prodi-detail-photo-wrap { width: 196px; height: 176px; }.prodi-detail-photo { display: block; width: 100%; height: 100%; object-fit: cover; border-radius: 18px; box-shadow: 0 10px 24px rgba(16,38,79,.15); }
    .prodi-detail-photo-placeholder { display: grid; place-items: center; color: #6280a5; background: linear-gradient(145deg,#e8eff7,#f5f8fc); font-size: 3.5rem; }
    .prodi-detail-identity { position: relative; z-index: 1; min-width: 0; }.prodi-detail-label { display: inline-flex; align-items: center; gap: .45rem; margin-bottom: .45rem; color: var(--pd-blue); font-size: .7rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; }
    .prodi-detail-identity h2 { margin: 0 0 .85rem; color: var(--pd-navy); font-size: clamp(1.75rem,3vw,2.45rem); font-weight: 800; line-height: 1.18; overflow-wrap: anywhere; }
    .prodi-detail-accreditation { display: inline-flex; align-items: center; gap: .4rem; padding: .45rem .75rem; color: #755a13; background: #fff7df; border: 1px solid #f1dfaa; border-radius: 999px; font-size: .76rem; font-weight: 750; }
    .prodi-detail-hero-meta { display: flex; flex-wrap: wrap; gap: 1.2rem; margin-top: .85rem; color: #53647c; font-size: .81rem; font-weight: 650; }.prodi-detail-hero-meta span { display: inline-flex; align-items: center; gap: .45rem; }.prodi-detail-hero-meta i { color: var(--pd-blue); }
    .prodi-detail-actions { display: flex; align-items: center; gap: 1rem; margin-top: 1.1rem; }.prodi-detail-actions .btn { display: inline-flex; align-items: center; gap: .45rem; }
    .prodi-detail-watermark { position: absolute; top: -2.7rem; right: .5rem; color: rgba(37,99,166,.045); font-size: 12rem; pointer-events: none; }
    .prodi-detail-stats { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 1rem; margin-top: 1.15rem; }
    .prodi-detail-stat-card { display: flex; align-items: center; gap: .85rem; min-width: 0; padding: 1rem 1.15rem; background: #fff; border: 1px solid var(--pd-line); border-radius: 17px; box-shadow: 0 7px 20px rgba(16,38,79,.04); }
    .prodi-detail-stat-icon { display: grid; place-items: center; flex: 0 0 42px; width: 42px; height: 42px; color: #257055; background: #e8f5ef; border-radius: 13px; }.prodi-detail-stat-blue { color: var(--pd-blue); background: #edf5ff; }.prodi-detail-stat-gold { color: #9c7618; background: #fff7df; }
    .prodi-detail-stat-card small,.prodi-detail-stat-card strong { display: block; }.prodi-detail-stat-card small { margin-bottom: .15rem; color: var(--pd-muted); font-size: .7rem; font-weight: 650; }.prodi-detail-stat-card strong { color: var(--pd-navy); font-size: 1.05rem; font-weight: 800; overflow-wrap: anywhere; }
    .prodi-detail-section { margin-top: 2.15rem; }.prodi-detail-section-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 1rem; margin-bottom: 1rem; }.prodi-detail-section-heading > div > span { color: var(--pd-blue); font-size: .66rem; font-weight: 800; letter-spacing: .13em; }.prodi-detail-section-heading h2 { margin: .22rem 0 0; color: var(--pd-navy); font-size: 1.3rem; font-weight: 800; }
    .prodi-detail-count { padding: .4rem .7rem; color: #4c6079; background: #f2f6fa; border: 1px solid var(--pd-line); border-radius: 999px; font-size: .7rem; font-weight: 700; white-space: nowrap; }
    .prodi-detail-student-grid,.prodi-detail-course-grid { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: .85rem; }
    .prodi-detail-student-card,.prodi-detail-course-card { display: flex; align-items: center; gap: .9rem; min-width: 0; padding: .9rem 1rem; background: #fff; border: 1px solid var(--pd-line); border-radius: 17px; box-shadow: 0 7px 20px rgba(16,38,79,.04); transition: transform .2s ease,box-shadow .2s ease,border-color .2s ease; }
    .prodi-detail-student-card:hover,.prodi-detail-course-card:hover { transform: translateY(-2px); border-color: #cad9eb; box-shadow: 0 12px 26px rgba(16,38,79,.08); }
    .prodi-detail-student-photo,.prodi-detail-student-placeholder { display: grid; place-items: center; flex: 0 0 54px; width: 54px; height: 54px; object-fit: cover; color: #6280a5; background: #edf3f9; border-radius: 15px; font-size: 1.35rem; }
    .prodi-detail-card-copy { flex: 1; min-width: 0; }.prodi-detail-card-copy h3 { margin: 0; color: var(--pd-navy); font-size: .9rem; font-weight: 800; line-height: 1.35; overflow-wrap: anywhere; }.prodi-detail-card-copy > span { display: block; margin-top: .3rem; color: var(--pd-muted); font-size: .72rem; }.prodi-detail-card-copy > span i { margin-right: .2rem; color: var(--pd-blue); }
    .prodi-detail-link { display: grid; place-items: center; flex: 0 0 34px; width: 34px; height: 34px; color: var(--pd-blue); background: #edf5ff; border-radius: 11px; transition: background .2s ease,color .2s ease; }.prodi-detail-link:hover { color: #fff; background: var(--pd-blue); }
    .prodi-detail-course-icon { display: grid; place-items: center; flex: 0 0 46px; width: 46px; height: 46px; color: var(--pd-blue); background: #edf5ff; border-radius: 14px; font-size: 1.05rem; }.prodi-detail-course-end { display: grid; grid-template-columns: auto auto; align-items: baseline; gap: .1rem .2rem; color: var(--pd-navy); text-align: right; }.prodi-detail-course-end strong { font-size: .95rem; }.prodi-detail-course-end small { color: var(--pd-muted); font-size: .63rem; font-weight: 700; }.prodi-detail-course-end .prodi-detail-link { grid-column: 1/-1; justify-self: end; margin-top: .25rem; }
    .prodi-detail-empty { padding: 2rem 1rem; color: var(--pd-muted); background: #fff; border: 1px dashed #ccd8e6; border-radius: 17px; text-align: center; }.prodi-detail-empty > i { display: inline-grid; place-items: center; width: 48px; height: 48px; color: var(--pd-blue); background: #edf5ff; border-radius: 15px; font-size: 1.25rem; }.prodi-detail-empty h3 { margin: .7rem 0 .25rem; color: var(--pd-navy); font-size: .95rem; font-weight: 800; }.prodi-detail-empty p { margin: 0; font-size: .78rem; }
    @media (max-width: 767.98px) { .prodi-detail-header { align-items: flex-start; }.prodi-detail-hero { grid-template-columns: 1fr; justify-items: center; gap: 1.1rem; padding: 1.4rem 1.15rem; text-align: center; }.prodi-detail-photo-wrap { width: 170px; height: 150px; }.prodi-detail-identity { width: 100%; }.prodi-detail-hero-meta,.prodi-detail-actions { justify-content: center; }.prodi-detail-watermark { top: .5rem; right: -1.5rem; font-size: 9rem; }.prodi-detail-stats { grid-template-columns: 1fr; gap: .65rem; }.prodi-detail-student-grid,.prodi-detail-course-grid { grid-template-columns: 1fr; } }
    @media (max-width: 480px) { .prodi-detail-breadcrumb { gap: .35rem; font-size: .68rem; }.prodi-detail-header h1 { font-size: 1.55rem; }.prodi-detail-back { padding: .65rem .8rem!important; font-size: .8rem!important; }.prodi-detail-back i { margin: 0!important; }.prodi-detail-section-heading h2 { font-size: 1.12rem; }.prodi-detail-student-card,.prodi-detail-course-card { gap: .65rem; padding: .8rem; }.prodi-detail-student-photo,.prodi-detail-student-placeholder { flex-basis: 46px; width: 46px; height: 46px; }.prodi-detail-course-icon { flex-basis: 40px; width: 40px; height: 40px; } }
</style>
@endsection