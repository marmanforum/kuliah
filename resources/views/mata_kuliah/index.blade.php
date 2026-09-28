@extends('layouts.app')

@section('title', 'Mata Kuliah')

@section('content')
<div class="page-header matkul-page-header">
    <div>
        <span class="section-tag">Kurikulum</span>
        <h1 class="page-title">Mata Kuliah</h1>
        <p class="page-subtitle">Kelola mata kuliah dan informasi akademik.</p>
    </div>

    <a href="{{ route('mata_kuliah.create') }}" class="btn btn-primary matkul-add-button">
        <i class="bi bi-plus-lg me-2"></i>Tambah Mata Kuliah
    </a>
</div>

<div class="search-toolbar matkul-search-toolbar">
    <div class="search-box matkul-search-box">
        <i class="bi bi-search"></i>
        <input type="text" class="search-input" placeholder="Cari mata kuliah..." data-search-target=".table-search-row">
    </div>
</div>

@if($mataKuliah->isNotEmpty())
    <div class="table-shell matkul-table-shell">
        <div class="table-responsive">
            <table class="table-modern matkul-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mataKuliah as $item)
                        @php
                            $mahasiswaNames = $item->mahasiswa->take(3);
                            $remainingMahasiswa = max($item->mahasiswa->count() - 3, 0);
                            $searchMahasiswa = $item->mahasiswa->pluck('nama_mahasiswa')->implode(' ');
                        @endphp
                        <tr class="table-search-row" data-search-text="{{ strtolower($item->nama_mata_kuliah . ' ' . $searchMahasiswa . ' ' . ($item->prodi?->nama_prodi ?? '')) }}">
                            <td>
                                <div class="photo-cell">
                                    @if($item->foto_mata_kuliah)
                                        <img src="{{ asset('storage/' . $item->foto_mata_kuliah) }}" alt="{{ $item->nama_mata_kuliah }}" class="course-thumb">
                                    @else
                                        <div class="course-thumb course-thumb-placeholder">
                                            <i class="bi bi-journal-bookmark-fill"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="course-name-wrap">
                                    <strong class="course-name">{{ $item->nama_mata_kuliah }}</strong>
                                    <span class="course-subtitle">Mata Kuliah Akademik</span>
                                </div>
                            </td>
                            <td>
                                <span class="table-badge sso-badge">{{ $item->sks }} SKS</span>
                            </td>
                            <td>
                                <span class="table-badge student-count-badge">
                                    <i class="bi bi-people-fill me-1"></i>
                                    {{ $item->mahasiswa->count() }} Mahasiswa
                                </span>
                            </td>
                            <td>
                                @if($item->prodi)
                                    <span class="table-badge prodi-badge">{{ $item->prodi->nama_prodi }}</span>
                                @else
                                    <span class="empty-inline-text">Belum ada prodi</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group modern-action-group">
                                    <a href="{{ route('mata_kuliah.show', $item) }}" class="btn btn-info"><i class="bi bi-eye me-1"></i>Detail</a>
                                    <a href="{{ route('mata_kuliah.edit', $item) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-1"></i>Edit</a>
                                    <form action="{{ route('mata_kuliah.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus mata kuliah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="empty-state matkul-empty-state">
        <div class="empty-state-icon"><i class="bi bi-journal-bookmark"></i></div>
        <h3>Belum Ada Mata Kuliah</h3>
        <p>Belum ada data mata kuliah yang tersedia. Silakan tambahkan mata kuliah baru.</p>
        <a href="{{ route('mata_kuliah.create') }}" class="btn btn-primary matkul-add-button mt-3">
            <i class="bi bi-plus-lg me-2"></i>Tambah Mata Kuliah
        </a>
    </div>
@endif
@endsection
