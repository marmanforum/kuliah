@extends('layouts.app')

@section('title', 'Mata Kuliah')

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Kurikulum</span>
        <h1 class="page-title">Mata Kuliah</h1>
        <p class="page-subtitle">Kelola mata kuliah dan informasi akademik.</p>
    </div>

    <a href="{{ route('mata_kuliah.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Mata Kuliah
    </a>
</div>

<div class="search-toolbar">
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" class="search-input" placeholder="Cari mata kuliah..." data-search-target=".table-search-row">
    </div>
</div>

@if($mataKuliah->isNotEmpty())
    <div class="info-card">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Mahasiswa</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mataKuliah as $item)
                        @php
                            $mahasiswaNames = $item->mahasiswa->pluck('nama_mahasiswa')->take(3)->all();
                            $searchMahasiswa = $item->mahasiswa->pluck('nama_mahasiswa')->implode(' ');
                        @endphp
                        <tr class="table-search-row" data-search-text="{{ strtolower($item->nama_mata_kuliah . ' ' . $searchMahasiswa . ' ' . ($item->prodi?->nama_prodi ?? '')) }}">
                            <td>{{ $item->nama_mata_kuliah }}</td>
                            <td>{{ $item->sks }}</td>
                            <td>
                                @if($item->mahasiswa->isNotEmpty())
                                    @foreach($mahasiswaNames as $index => $name)
                                        <span class="chip me-1 mb-1 d-inline-flex">{{ $name }}</span>
                                    @endforeach
                                    @if($item->mahasiswa->count() > 3)
                                        <span class="chip d-inline-flex">+{{ $item->mahasiswa->count() - 3 }}</span>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->prodi?->nama_prodi ?? '-' }}</td>
                            <td>
                                <div class="action-group">
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
    <div class="empty-state">
        <h3>Belum ada mata kuliah</h3>
        <p>Tambahkan mata kuliah pertama untuk memulai katalog akademik.</p>
    </div>
@endif
@endsection
