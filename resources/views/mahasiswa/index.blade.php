@extends('layouts.app')

@section('title', 'Mahasiswa')

@section('content')
<div class="page-header">
    <div>
        <span class="section-tag">Kemahasiswaan</span>
        <h1 class="page-title">Data Mahasiswa</h1>
        <p class="page-subtitle">Kelola informasi mahasiswa yang terdaftar.</p>
    </div>

    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Mahasiswa
    </a>
</div>

<div class="search-toolbar">
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" class="search-input" placeholder="Cari mahasiswa..." data-search-target=".table-search-row">
    </div>
</div>

@if($mahasiswa->isNotEmpty())
    <div class="info-card">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $item)
                        <tr class="table-search-row" data-search-text="{{ strtolower($item->nim . ' ' . $item->nama_mahasiswa . ' ' . ($item->prodi?->nama_prodi ?? '')) }}">
                            <td>
                                @if($item->foto_mahasiswa)
                                    <img src="{{ Storage::url($item->foto_mahasiswa) }}" alt="Foto {{ $item->nama_mahasiswa }}" class="avatar-table">
                                @else
                                    <div class="avatar-table d-flex align-items-center justify-content-center bg-light text-primary">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama_mahasiswa }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->prodi?->nama_prodi ?? 'Belum Mengikuti Prodi' }}</td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('mahasiswa.show', $item) }}" class="btn btn-info"><i class="bi bi-eye me-1"></i>Detail</a>
                                    <a href="{{ route('mahasiswa.edit', $item) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-1"></i>Edit</a>
                                    <form action="{{ route('mahasiswa.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data mahasiswa ini?')">
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
        <h3>Belum ada mahasiswa</h3>
        <p>Tambahkan mahasiswa pertama untuk memulai data akademik.</p>
    </div>
@endif
@endsection
