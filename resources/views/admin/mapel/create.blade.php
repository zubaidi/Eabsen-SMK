@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran - Admin')
@section('header_title', 'Tambah Mata Pelajaran')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Mata Pelajaran</h4>
        </div>
        <div class="card-body">
            <!-- Menampilkan error validasi -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.mapel.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="kode_mapel">Kode Mapel</label>
                    <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" placeholder="Contoh: PAI, MTK, PWEB" value="{{ old('kode_mapel') }}" required>
                </div>
                <div class="form-group mb-4">
                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Contoh: Pendidikan Agama Islam" value="{{ old('nama_mapel') }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</section>
@endsection