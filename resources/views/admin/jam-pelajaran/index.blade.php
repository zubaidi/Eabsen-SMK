@extends('layouts.app')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Master Data Jam Pelajaran</h5>
            <a href="{{ route('admin.jam-pelajaran.create') }}" class="btn btn-primary btn-sm">Tambah Jam</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jam Ke-</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jams as $jam)
                    <tr>
                        <td>Jam {{ $jam->jam_ke }}</td>
                        <td>{{ \Carbon\Carbon::parse($jam->waktu_mulai)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($jam->waktu_selesai)->format('H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.jam-pelajaran.edit', $jam->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.jam-pelajaran.destroy', $jam->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jam pelajaran ini?')">
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