@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Tambah Jam Pelajaran</h4></div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jam-pelajaran.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Jam Ke- (Angka)</label>
                <input type="number" name="jam_ke" class="form-control" placeholder="Contoh: 1" value="{{ old('jam_ke') }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Waktu Mulai</label>
                <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}" required>
            </div>

            <div class="form-group mb-4">
                <label>Waktu Selesai</label>
                <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') }}" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.jam-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection