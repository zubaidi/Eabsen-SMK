@extends('layouts.app')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Penugasan Guru</h5>
            <a href="{{ route('admin.penugasan.create') }}" class="btn btn-primary btn-sm">Tambah Penugasan</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Guru</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penugasans as $tugas)
                    <tr>
                        <td>{{ $tugas->guru->nama ?? 'Guru Dihapus' }}</td>
                        <td>{{ $tugas->mapel->nama_mapel ?? 'Mapel Dihapus' }}</td>
                        <td>{{ $tugas->kelas->nama_kelas ?? 'Kelas Dihapus' }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.penugasan.edit', $tugas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.penugasan.destroy', $tugas->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cabut penugasan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
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