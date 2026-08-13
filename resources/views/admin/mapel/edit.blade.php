@extends('layouts.app')

@section('title', 'Edit Mata Pelajaran - Admin')
@section('header_title', 'Edit Mata Pelajaran')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Mata Pelajaran</h4>
        </div>
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

            <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Wajib untuk proses update di Laravel -->
                
                <div class="form-group mb-3">
                    <label for="kode_mapel">Kode Mapel</label>
                    <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" value="{{ old('kode_mapel', $mapel->kode_mapel) }}" required>
                </div>
                <div class="form-group mb-4">
                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                </div>
                
                <button type="submit" class="btn btn-warning">Update Data</button>
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</section>
@endsection