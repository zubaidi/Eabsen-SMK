@extends('layouts.app')

@section('title', 'Data Kelas - Admin')
@section('header_title', 'Master Data Kelas')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Kelas</h5>
            <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Tambah Kelas</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelases as $kelas)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm" class="d-inline">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
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