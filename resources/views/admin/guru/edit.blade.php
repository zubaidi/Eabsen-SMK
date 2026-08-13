@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Edit Akun Login Guru</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label>NIP / NIK</label>
                <input type="text" name="nip_nik" class="form-control" value="{{ old('nip_nik', $guru->nip_nik) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Nama Lengkap (Beserta Gelar)</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $guru->nama) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Email Login</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $guru->email) }}" required>
            </div>
            
            <div class="form-group mb-4">
                <label>Password Baru <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password saat ini.</small>
            </div>
            
            <button type="submit" class="btn btn-warning">Update Akun</button>
            <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection