@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Tambah Akun Login Guru</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.guru.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>NIP / NIK</label>
                <input type="text" name="nip_nik" class="form-control" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Nama Lengkap (Beserta Gelar)</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Email Login</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group mb-4">
                <label>Password Login</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Akun</button>
            <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection