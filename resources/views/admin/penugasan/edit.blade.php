@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Edit Penugasan Mengajar</h4></div>
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

        <form action="{{ route('admin.penugasan.update', $penugasan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label>Pilih Guru</label>
                <select name="guru_id" class="form-select" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}" {{ (old('guru_id', $penugasan->guru_id) == $guru->id) ? 'selected' : '' }}>
                            {{ $guru->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group mb-3">
                <label>Pilih Mata Pelajaran</label>
                <select name="mapel_id" class="form-select" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mapels as $mapel)
                        <option value="{{ $mapel->id }}" {{ (old('mapel_id', $penugasan->mapel_id) == $mapel->id) ? 'selected' : '' }}>
                            {{ $mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label>Pilih Kelas</label>
                <select name="kelas_id" class="form-select" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelases as $kelas)
                        <option value="{{ $kelas->id }}" {{ (old('kelas_id', $penugasan->kelas_id) == $kelas->id) ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-warning">Update Penugasan</button>
            <a href="{{ route('admin.penugasan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection