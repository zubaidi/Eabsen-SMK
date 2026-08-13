@extends('layouts.app')

@section('title', 'Data Mata Pelajaran - Admin')
@section('header_title', 'Master Data Mata Pelajaran')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Mata Pelajaran</h5>
            <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Tambah Mapel</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mapels as $mapel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mapel->kode_mapel }}</td>
                        <td>{{ $mapel->nama_mapel }}</td>
                        <td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="btn btn-warning btn-sm" class="d-inline">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    
                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection