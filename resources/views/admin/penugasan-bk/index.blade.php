@extends('layouts.app')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Kelas Binaan BK</h5>
            <a href="{{ route('admin.penugasan-bk.create') }}" class="btn btn-primary btn-sm">Tambah Penugasan BK</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Guru BK</th>
                        <th>Kelas Binaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penugasans as $tugas)
                    <tr>
                        <td>{{ $tugas->bkUser->nama ?? 'Akun BK Dihapus' }}</td>
                        <td>{{ $tugas->kelas->nama_kelas ?? 'Kelas Dihapus' }}</td>
                        <td>
                            <form action="{{ route('admin.penugasan-bk.destroy', $tugas->id) }}" method="POST" onsubmit="return confirm('Cabut penugasan kelas ini?')">
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