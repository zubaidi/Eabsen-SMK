@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Edit Data Siswa</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ old('nis', $siswa->nis) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Nama Siswa</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $siswa->nama) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-select" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelases as $kelas)
                        <!-- Logika untuk memilih kelas yang tersimpan sebelumnya -->
                        <option value="{{ $kelas->id }}" {{ (old('kelas_id', $siswa->kelas_id) == $kelas->id) ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group mb-4">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="L" {{ (old('jenis_kelamin', $siswa->jenis_kelamin) == 'L') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ (old('jenis_kelamin', $siswa->jenis_kelamin) == 'P') ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection