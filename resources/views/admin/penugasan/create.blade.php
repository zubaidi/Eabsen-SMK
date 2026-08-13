@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Tambah Penugasan Mengajar</h4></div>
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

        <form action="{{ route('admin.penugasan.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Pilih Guru</label>
                <select name="guru_id" class="form-select" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group mb-3">
                <label>Pilih Mata Pelajaran</label>
                <select name="mapel_id" class="form-select" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mapels as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label>Pilih Kelas</label>
                <select name="kelas_id" class="form-select" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelases as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Penugasan</button>
            <a href="{{ route('admin.penugasan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection