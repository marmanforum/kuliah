@extends('layouts.app')

@section('title', 'Program Studi')

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Akademik</span>
        <h1 class="page-title">Program Studi</h1>
        <p class="page-subtitle">Kelola program studi yang tersedia di institusi.</p>
    </div>

    <a href="{{ route('prodi.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Program Studi
    </a>
</div>

<div class="search-toolbar">
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" class="search-input" placeholder="Cari program studi..." data-search-target=".prodi-card-searchable">
    </div>
</div>

@if($prodi->isNotEmpty())
    <div class="prodi-grid">
        @foreach($prodi as $item)
            <article class="prodi-card prodi-card-searchable" data-search-text="{{ strtolower($item->nama_prodi . ' ' . $item->akreditasi) }}">
                <div class="prodi-cover">
                    @if($item->foto_profil)
                        <img src="{{ Storage::url($item->foto_profil) }}" alt="Foto {{ $item->nama_prodi }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-white fs-1">
                            <i class="bi bi-building"></i>
                        </div>
                    @endif
                </div>

                <div class="prodi-body">
                    <div class="prodi-top">
                        <h2 class="prodi-name">{{ $item->nama_prodi }}</h2>
                        <span class="akreditasi-badge">{{ $item->akreditasi }}</span>
                    </div>

                    <div class="prodi-stats">
                        <div class="small-stat">
                            <strong>{{ $item->mahasiswa_count }}</strong>
                            <span>Mahasiswa</span>
                        </div>
                        <div class="small-stat">
                            <strong>{{ $item->mata_kuliah_count }}</strong>
                            <span>Mata Kuliah</span>
                        </div>
                    </div>

                    <div class="action-group">
                        <a href="{{ route('prodi.show', $item->id) }}" class="btn btn-info"><i class="bi bi-eye me-1"></i>Detail</a>
                        <a href="{{ route('prodi.edit', $item->id) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-1"></i>Edit</a>
                        <form action="{{ route('prodi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus program studi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Hapus</button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <h3>Belum ada program studi</h3>
        <p>Tambahkan program studi pertama untuk mulai mengelola data akademik.</p>
    </div>
@endif
@endsection